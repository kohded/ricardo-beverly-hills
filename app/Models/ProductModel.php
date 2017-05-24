<?php

namespace App\Models;

use app\Log\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductModel
{
	// Select all products
	public function getProducts($productsPerPage = null, $request = null)
	{
        $searchString = null;
        $searchField = null;
        $brand = "";

        if (isset($request))
        {
            $searchString = $request->input('searchProduct');
            $searchField = $request->input('fieldProduct');
            $brand = $request->input('brand');
        }

        if(isset($searchString)){
            $request->session()->put('searchProduct', $searchString);
        }
        if(isset($searchField)){
            $request->session()->put('fieldProduct', $searchField);
        }
        if(isset($brand)){
            $request->session()->put('brand', $brand);
        }

        $searchString = $request->session()->get('searchProduct');
        $searchField = $request->session()->get('fieldProduct');
        $brand = $request->session()->get('brand');

        $filterType = $request->session()->get('filterTypeProduct');
        $filterOrder = $request->session()->get('filterOrder');

        if(empty($filterType) || empty($filterOrder)) {

            $filterType = 'collection';
            $filterOrder = 'asc';
        }

        $products = DB::table('product')
            ->select(
                'style',
                'description',
                'brand',
                'warranty_years',
                'color',
                'collection',
                \DB::raw('DATE_FORMAT(launch_date, "%m/%d/%Y") as launch_date')
            )
            ->orderBy($filterType, $filterOrder)
            ->when($searchString, function($query) use($searchString, $searchField) {
                if ($searchField === 'style')
                {
                    return $query->where('style', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'description')
                {
                    return $query->where('description', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'warranty')
                {
                    return $query->where('warranty_years', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'collection')
                {
                    return $query->where('collection', 'like', '%' . $searchString . '%');
                }
                else
                {
                    return $query->where('style', 'like', '%' . $searchString . '%')
                                ->orWhere('description', 'like', '%' . $searchString . '%')
                                ->orWhere('warranty_years', 'like', '%' . $searchString . '%')
                                ->orWhere('collection', 'like', '%' . $searchString . '%');
                }
            })

            ->when($brand === "rbh", function($query) {
                return $query->where('brand', '=', "Ricardo Beverly Hills");
            })
            ->when($brand === "skye", function($query) {
                return $query->where('brand', '=', "Skye");
            })

            ->when($productsPerPage, function ($query) use ($productsPerPage) {
                return $query->paginate($productsPerPage);
            }, function ($query) {
                return $query->get();
            });

		return $products;
	}

	// Select product by style
	public function getProduct($style)
	{
		$product = DB::table('product')->where('style', $style)->get();

		foreach($product as $key => $value)
		{
			if($value->launch_date)
			{
				$value->launch_date = Carbon::createFromFormat('Y-m-d', $value->launch_date)->format('m/d/Y');
			}
		}

		return $product;
	}

	// Insert new product
	public function createProduct($style, $description, $brand, $warranty, $color, $collection, $launch)
	{
	    $createProductValues = [
            'style' 		       => $style,
            'description' 	       => $description,
            'brand'                => $brand,
            'warranty_years'       => $warranty,
            'color'                => $color,
            'collection'           => $collection,
            'launch_date'          => $launch
        ];

		DB::table('product')->insert($createProductValues);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'New Product Created');
        $UALog->insertAllValues(array_keys($createProductValues), array_values($createProductValues));
	}

	// Edit product by style
	public function editProduct($style, $description, $brand, $warranty, $color, $collection, $launch)
	{

        $editProductValues = [
            'style' 		       => $style,
            'description' 	       => $description,
            'brand'                => $brand,
            'warranty_years'       => $warranty,
            'color'                => $color,
            'collection'           => $collection,
            'launch_date'          => $launch
        ];

		DB::table('product')->where('style', $style)->update($editProductValues);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Product Edited');
        $UALog->insertAllValues(array_keys($editProductValues), array_values($editProductValues));
	}

	// Delete product
	public function deleteProduct($style)
	{
        $deleteCustomerValues = (array) DB::table('product')->where('style', '=', $style)->get()[0];

		DB::table('product')->where('style', '=', $style)->delete();

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Product Deleted');
        $UALog->insertAllValues(array_keys($deleteCustomerValues), array_values($deleteCustomerValues));

	}


}