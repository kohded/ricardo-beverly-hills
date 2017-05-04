<?php

namespace App\Http\Controllers\Mail;
use PDF;
use App\Http\Controllers\Controller;
use App\Models\ClaimModel;
use App\Models\Mail\MailClaimModel;

class MailClaimController extends Controller
{
    private const RBH_EMAIL = 'ricardobevhills@gmail.com';
    // REPLACE WITH TWC EMAIL IN PRODUCTION.
    private const TWC_EMAIL = 'twc@gmail.com';
    private $claimId;
    private $claim;
    private $claimComments;
    private $claimPdf;
    private $customerName;
    private $customerEmail;
    private $packingSlipPdf;
    private $repairCenterName;
    private $repairCenterEmail;
    private $rbhName;
    private $twcName;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $claimModel = new ClaimModel();
        $this->claimId = $request->input('claim-id');
        $this->claim = $claimModel->getClaim($this->claimId);
        $this->claimComments = $claimModel->getComments($this->claimId);
        $this->customerName = $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name;
        $this->customerEmail = $this->claim[0]->cust_email;
        $this->repairCenterName = $this->claim[0]->rc_name;
        $this->repairCenterEmail = $this->claim[0]->rc_email;
        $this->rbhName = 'Ricardo Beverly Hills';
        $this->twcName = 'T.W. Carrol & Co.';

        // Create pdf Repair or Replace order claim
        if ($this->claim[0]->replace_order === 0) {
            $this->claimPdf = PDF::loadView('pdf.repair-order', ['claim' => $this->claim, 'comments' => $this->claimComments])->download();
        } else {
            $this->claimPdf = PDF::loadView('pdf.replace-order', ['claim' => $this->claim, 'comments' => $this->claimComments])->download();
        }
    }

    /**
     * Send new warranty claim mail.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendNewWarrantyClaimMail()
    {
        if((int) $this->claim[0]->replace_order === 0) { // Repair Order
            $this->sendNewWarrantyClaimRepairMail();
        } elseif((int) $this->claim[0]->replace_order === 1) { // Replace Order
            $this->sendNewWarrantyClaimReplaceMail();
        }

        $this->incrementEmailSentCount();

        // Redirect with email message.
        return redirect()->back()->with('email-message', [
            'message'       => 'Email sent successfully to:',
            'customer'      => $this->customerName,
            'repair-center' => $this->repairCenterName,
            'rbh'           => $this->rbhName,
            'twc'           => $this->twcName,
        ]);
    }

    /**
     * sendNewWarrantyClaimMail() helper function to send repair mail.
     */
    private function sendNewWarrantyClaimRepairMail()
    {
        if((int) $this->claim[0]->part_needed === 0) { // Part Not Required
            \Mail::to($this->customerEmail)
                ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter\CustomerMail($this->claim, $this->claimPdf));
            \Mail::to($this::RBH_EMAIL)
                ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter\RBHMail($this->claim, $this->claimComments, $this->claimPdf));
            \Mail::to($this->repairCenterEmail)
                ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter\RepairCenterMail($this->claim, $this->claimPdf));

            $this->twcName = '';
        } elseif((int) $this->claim[0]->part_needed === 1) { // Part Required
            if($this->claim[0]->ship_to === 'Customer') {
                \Mail::to($this->customerEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\Customer\CustomerMail($this->claim, $this->claimPdf));
                \Mail::to($this::RBH_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\Customer\RBHMail($this->claim, $this->claimComments, $this->claimPdf));
                \Mail::to($this::TWC_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\Customer\TWCMail($this->claim, $this->claimComments, $this->claimPdf));
                $this->repairCenterName = '';
            } elseif($this->claim[0]->ship_to === 'Repair Center') {
                \Mail::to($this->customerEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\CustomerMail($this->claim, $this->claimPdf));
                \Mail::to($this::RBH_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\RBHMail($this->claim, $this->claimComments, $this->claimPdf));
                \Mail::to($this->repairCenterEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\RepairCenterMail($this->claim, $this->claimPdf));
                \Mail::to($this::TWC_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\TWCMail($this->claim, $this->claimComments, $this->claimPdf));
            }
        }
    }

    /**
     * sendNewWarrantyClaimMail() helper function to send replace mail.
     */
    private function sendNewWarrantyClaimReplaceMail()
    {
        \Mail::to($this->customerEmail)
            ->send(new \App\Mail\Claim\ReplaceOrder\CustomerMail($this->claim, $this->claimPdf));
        $this->repairCenterName = '';
        $this->rbhName = '';
        $this->twcName = '';
    }

    /**
     * Send convert to replace order mail.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendConvertToReplaceOrderMail()
    {
        if($this->claim[0]->ship_to === 'Customer') {
            \Mail::to($this->customerEmail)
                ->send(new \App\Mail\Claim\ReplaceOrder\CustomerMail($this->claim, $this->claimPdf));
            $this->repairCenterName = '';
        } elseif($this->claim[0]->ship_to === 'Repair Center') {
            \Mail::to($this->customerEmail)
                ->send(new \App\Mail\Claim\ReplaceOrder\CustomerMail($this->claim, $this->claimPdf));
            \Mail::to($this->repairCenterEmail)
                ->send(new \App\Mail\Claim\ReplaceOrder\RepairCenterMail($this->claim, $this->claimPdf));
        }

        $this->incrementEmailSentCount();

        // Redirect with email message.
        return redirect()->back()->with('email-message', [
            'message'       => 'Email sent successfully to:',
            'customer'      => $this->customerName,
            'repair-center' => $this->repairCenterName,
            'rbh'           => '',
            'twc'           => '',
        ]);
    }

    /**
     * Send email when RBH submits tracking number for replace order.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendReplaceOrderTrackingNumberMail()
    {
        \Mail::to($this->customerEmail)
            ->send(new \App\Mail\Claim\ReplaceOrder\TrackingNumber\CustomerTrackingMail($this->claim, $this->claimPdf));

        $this->incrementEmailSentCount();

        // Redirect with email message.
        return redirect()->back()->with('email-message', [
            'message'       => 'Email sent successfully to:',
            'customer'      => $this->customerName,
            'repair-center' => '',
            'rbh'           => '',
            'twc'           => '',
        ]);
    }

    /**
     * Send email when part company submits tracking number for part order.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendPartOrderTrackingNumberMail()
    {
        \Mail::to($this->customerEmail)
            ->send(new \App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber\CustomerTrackingMail($this->claim, $this->claimPdf));
        \Mail::to($this::RBH_EMAIL)
            ->send(new \App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber\RBHTrackingMail($this->claim, $this->claimComments, $this->claimPdf));

        if($this->claim[0]->ship_to === 'Repair Center') {
            \Mail::to($this->repairCenterEmail)
                ->send(new \App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber\RepairCenterTrackingMail($this->claim, $this->claimPdf));
        } else {
            $this->repairCenterName = '';
        }

        $this->incrementEmailSentCount();

        // Redirect with email message.
        return redirect()->back()->with('email-message', [
            'message'       => 'Email sent successfully to:',
            'customer'      => $this->customerName,
            'repair-center' => $this->repairCenterName,
            'rbh'           => $this->rbhName,
            'twc'           => '',
        ]);
    }

    /**
     * Send email when part company submits no part available.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendNoPartMail()
    {
        \Mail::to($this::RBH_EMAIL)
            ->send(new \App\Mail\Claim\RepairOrder\PartRequired\NoPart\RBHNoPartMail($this->claim, $this->claimComments, $this->claimPdf));

        $this->incrementEmailSentCount();

        // Redirect with email message.
        return redirect()->back()->with('email-message', [
            'message'       => 'Email sent successfully to:',
            'customer'      => '',
            'repair-center' => '',
            'rbh'           => $this->rbhName,
            'twc'           => '',
        ]);
    }

    /**
     * Increment email sent count for claim.
     */
    private function incrementEmailSentCount()
    {
        $mailModel = new MailClaimModel();
        $mailModel->incrementEmailSentCount($this->claimId);
    }
}
