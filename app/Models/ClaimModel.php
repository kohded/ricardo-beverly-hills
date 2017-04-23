<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class ClaimModel
{
	// Select all products
	public function getClaims($claimsPerPage = null, $request, $role)
	{
        $rcId = $request->input('rc');
        $product = $request->input('product');
        $searchString = $request->input('search');
        $searchField = $request->input('field');
        $status = $request->input('status');

        $filterType = $request->session()->get('filterType');
        $filterOrder = $request->session()->get('filterOrder');

        if(isset($rcId)){
        $request->session()->put('rc', $rcId);
        }
        if(isset($product)){
            $request->session()->put('product', $product);
        }
        if(isset($searchString)){
            $request->session()->put('search', $searchString);
        }
        if(isset($searchField)){
            $request->session()->put('field', $searchField);
        }
        if(isset($status)){
            $request->session()->put('status', $status);
        }

        $rcId = $request->session()->get('rc');
        $product = $request->session()->get('product');
        $searchString = $request->session()->get('search');
        $searchField = $request->session()->get('field');
        $status = $request->session()->get('status');

        if(empty($filterType) && empty($filterOrder)) {

            $filterType = 'created_at';
            $filterOrder = 'desc';
        }


		$claims = DB::table('claim')
            ->join('customer', 'claim.customer_id', '=', 'customer.id')
            ->join('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->select('claim.id as claim_id',
                    'claim.product_style as style',
                    \DB::raw('DATE_FORMAT(claim.created_at, "%m/%d/%Y") as created_at'),
                    \DB::raw('DATE_FORMAT(claim.date_closed, "%m/%d/%Y") as closed_at'),
                    'claim.parts_available as parts_available',
                    'claim.part_needed as part_needed',
                    'claim.tracking_number as tracking_number',
                    'claim.replace_order as replace_order',
                    'customer.first_name as first', 
                    'customer.last_name as last',
                    'repair_center.name as repair_center', 
                    'repair_center.id as repair_center_id'
                    )
            ->orderBy($filterType, $filterOrder)

            // TWC - Only show repair claims where part_needed == 1
            ->when($role == "partCompany", function($query) {
                return $query->where('claim.part_needed', '=', 1)
                             ->where('claim.replace_order', '=', 0);
            })

            // Search
            ->when($searchString, function($query) use($searchString, $searchField) {
                if ($searchField === 'claim')
                {
                    return $query->where('claim.id', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'cust')
                {
                    return $query->where('customer.first_name', 'like', '%' . $searchString . '%')
                                ->orWhere('customer.last_name', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'rc')
                {
                    return $query->where('repair_center.name', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'product')
                {
                    return $query->where('claim.product_style', 'like', '%' . $searchString . '%');
                }
                else
                {
                    return $query->where('claim.id', 'like', '%' . $searchString . '%')
                                ->orWhere('customer.first_name', 'like', '%' . $searchString . '%')
                                ->orWhere('customer.last_name', 'like', '%' . $searchString . '%')
                                ->orWhere('claim.product_style', 'like', '%' . $searchString . '%')
                                ->orWhere('repair_center.name', 'like', '%' . $searchString . '%');
                }
            })

            // Product Filter
            ->when($product, function($query) use($product) {
                return $query->where('claim.product_style', '=', $product);
            })

            // Repair Center Filter
            ->when($rcId, function($query) use($rcId) {
                return $query->where('repair_center.id', '=', $rcId);
            })

            // Claim Status Filter
            ->when($status === "Open", function($query) {
                return $query->where('claim.date_closed', '=', null);
            })
            ->when($status === "Closed", function($query) {
                return $query->where('claim.date_closed', '!=', null);
            })

            // Pagination
            ->when($claimsPerPage, function ($query) use ($claimsPerPage) {
                return $query->paginate($claimsPerPage);
            }, function ($query) {
                return $query->get();
            });

		return $claims;
	}

    // Select claim by ID
    public function getClaim($id)
    {
        //$claim = DB::table('claim')->where('id', '=', $id)->get();
        $claim = DB::table('claim')
            ->join('customer', 'claim.customer_id', '=', 'customer.id')
            ->join('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->join('damage_code', 'claim.damage_code_id', '=', 'damage_code.id')
            ->join('product', 'claim.product_style', '=', 'product.style')
            ->select(
                'claim.id as claim_id',
                'claim.customer_id as cust_id',
                \DB::raw('DATE_FORMAT(claim.created_at, "%m/%d/%Y") as claim_created_at'),
                \DB::raw('DATE_FORMAT(claim.date_closed, "%m/%d/%Y") as claim_date_closed'),
                'claim.email_sent as claim_email_sent',
                'claim.replace_order as replace_order',
                'claim.ship_to as ship_to', 
                'claim.part_needed as part_needed',
                'claim.parts_needed as parts_needed',
                'claim.parts_available as parts_available',
                'claim.tracking_number as tracking_number',
                'claim.part_company_comment as part_company_comment',
                'customer.address as cust_address',
                'customer.address_2 as cust_address_2',
                'customer.city as cust_city',
                'customer.email as cust_email',
                'customer.first_name as cust_first_name',
                'customer.last_name as cust_last_name',
                \DB::raw("CONCAT('(', SUBSTRING(customer.phone, 1, 3), ') ', 
                                      SUBSTRING(customer.phone, 4, 3), '-',
                                      SUBSTRING(customer.phone, 7, 4)) as cust_phone"),
                'customer.state as cust_state',
                'customer.zip as cust_zip',
                'product.style as product_style',
                'repair_center.id as rc_id',
                'repair_center.address as rc_address',
                'repair_center.name as rc_name',
                'repair_center.city as rc_city',
                'repair_center.state as rc_state',
                'repair_center.contact_name as rc_contact',
                \DB::raw("CONCAT('(', SUBSTRING(repair_center.phone, 1, 3), ') ', 
                                      SUBSTRING(repair_center.phone, 4, 3), '-',
                                      SUBSTRING(repair_center.phone, 7, 4)) as rc_phone"),
                'repair_center.email as rc_email',
                'repair_center.zip as rc_zip',
                'damage_code.id as dc_id',
                'damage_code.part as dc_part'
            )
            ->where('claim.id', '=', $id)
            ->get();
        return $claim;
    }

    public function insertClaim($existing_customer_email, $customerData ,$comment, $products, $damage_code, $repair_center, $replace_order, $ship_to, $part_needed, $parts_needed, $updateSwitch){


        DB::beginTransaction();

        $isCustomerInDB = false;

        try {

            $customers = DB::table('customer')->get();

            //Checks to see if customer exists in the db, if it does then the insert new customer step is skipped

            foreach($customers as $customer){

                if($customer->email == $customerData['email'] || $customer->email == $existing_customer_email) {

                    $isCustomerInDB = true;
                    break;
                }
            }

            if(!$isCustomerInDB && $updateSwitch == 0) {

                DB::table('customer')->insert([
                    'first_name' => $customerData['first_name'],
                    'last_name' => $customerData['last_name'],
                    'address' => $customerData['address'],
                    'address_2' => $customerData['address_2'],
                    'city' => $customerData['city'],
                    'state' => $customerData['state'],
                    'zip' => $customerData['zip'],
                    'phone' => $customerData['phone'],
                    'email' => $customerData['email']
                ]);

                $customerID = DB::table('customer')->where('customer.email', '=', $customerData['email'])->pluck('id')[0];

            } else if(!empty($existing_customer_email) && $isCustomerInDB && empty($customerData['email'])){

                $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);

                $customerID = DB::table('customer')->where('customer.email', '=', $existing_customer_email)->select('id')->pluck('id')[0];

                $output->writeln($customerID);


            } else {
                DB::rollback();

                return redirect()->route('claim-index')->withErrors('Customer with that email already exists.');
            }

            DB::table('claim')->insert([
                'customer_id'      => $customerID,
                'product_style'    => $products,
                'damage_code_id'   => $damage_code,
                'repair_center_id' => $repair_center,
                'replace_order'    => $replace_order,
                'ship_to'          => $ship_to,
                'part_needed'      => $part_needed,
                'parts_needed'     => $parts_needed
            ]);

            $claimID = DB::table('claim')->orderBy('claim.id', 'Desc')->pluck('claim.id')->first();

            DB::table('claim_comment')->insert([
                'claim_id' => $claimID,
                'author' => Auth::user()->id . ' : ' . Auth::user()->name,
                'comment' => $comment
            ]);

            DB::table('claim_customer')->insert([
                'claim_id' => $claimID,
                'customer_id' => $customerID
            ]);

        } catch (ValidationException $e)
        {
            DB::rollback();

        } catch (\Exception $e) {

            DB::rollback();
            throw $e;

        }

        DB::commit();
    }

    public function insertComment($claimID, $comment)
    {
            DB::table('claim_comment')->insert([
                'author' => Auth::user()->name,
                'claim_id' => $claimID,
                'comment' => $comment
            ]);
    }

    public function getMostRecentClaimId()
    {
        return DB::table('claim')->orderBy('claim.id', 'Desc')->pluck('claim.id')->first();
    }

    public function deleteClaim($id)
    {
        DB::table('claim')->where('id', '=', $id)->delete();
    }

    // Get comments for a claim
    public function getComments($id)
    {
        $comments = DB::table('claim_comment')
            ->where('claim_id', '=', $id)
            ->select(
                'author as author',
                'created_at as created', // Alias for orderBy only.
                \DB::raw('DATE_FORMAT(created_at, "%m/%d/%Y %h:%i%p") as created_at'),
                'comment as comment'
            )
            ->orderBy('created', 'desc')
            ->get();

        return $comments;
    }

    public function updateClaim($claimId, $customerId, $product, $repairCenter, 
                                $damageCode, $claimType, $partsRequired, $partsNeeded, 
                                $shipPartsTo) {

        DB::table('claim')
            ->where('id', '=', $claimId)
            ->update([
                'customer_id' => $customerId,
                'product_style' => $product,
                'repair_center_id' => $repairCenter,
                'damage_code_id' => $damageCode,
                'replace_order' => $claimType,
                'part_needed' => $partsRequired,
                'parts_needed' => $partsNeeded,
                'ship_to' => $shipPartsTo
        ]);
    }

    public function convertToReplaceOrder($id)
    {
        DB::table('claim')
            ->where('id', '=', $id)
            ->update(['replace_order' => 1]);
    }

    public function enterPartAvailability($id, $partsAvailable, $partCompanyComment) 
    {
        DB::table('claim')
            ->where('id', '=', $id)
            ->update([
                'parts_available' => $partsAvailable,
                'part_company_comment' => $partCompanyComment
            ]);
    }

    public function enterTrackingNumber($id, $trackingNumber) 
    {
        DB::table('claim')
            ->where('id', '=', $id)
            ->update([
                'tracking_number' => $trackingNumber
            ]);
    }

    public function closeClaim($id)
    {
    	DB::table('claim')
            ->where('id', '=', $id)
            ->update([
                'date_closed' => Carbon::now()
            ]);
    }
}