<?php

namespace App\Http\Controllers\Mail;

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
    private $customerName;
    private $customerEmail;
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
            if($this->claim[0]->ship_to === 'Customer') {
                \Mail::to($this->customerEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\Customer\CustomerMail($this->claim));
                \Mail::to($this::RBH_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\Customer\RBHMail($this->claim, $this->claimComments));
                // Clear name so it doesn't show in claim.blade.php
                $this->repairCenterName = '';
            } elseif($this->claim[0]->ship_to === 'Repair Center') {
                \Mail::to($this->customerEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter\CustomerMail($this->claim));
                \Mail::to($this::RBH_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter\RBHMail($this->claim, $this->claimComments));
                \Mail::to($this->repairCenterEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter\RepairCenterMail($this->claim));
            }

            $this->twcName = '';
        } elseif((int) $this->claim[0]->part_needed === 1) { // Part Required
            if($this->claim[0]->ship_to === 'Customer') {
                \Mail::to($this->customerEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\Customer\CustomerMail($this->claim));
                \Mail::to($this::RBH_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\Customer\RBHMail($this->claim, $this->claimComments));
                \Mail::to($this::TWC_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\Customer\TWCMail($this->claim, $this->claimComments));
                $this->repairCenterName = '';
            } elseif($this->claim[0]->ship_to === 'Repair Center') {
                \Mail::to($this->customerEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\CustomerMail($this->claim));
                \Mail::to($this::RBH_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\RBHMail($this->claim, $this->claimComments));
                \Mail::to($this->repairCenterEmail)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\RepairCenterMail($this->claim));
                \Mail::to($this::TWC_EMAIL)
                    ->send(new \App\Mail\Claim\RepairOrder\PartRequired\RepairCenter\TWCMail($this->claim, $this->claimComments));
            }
        }
    }

    /**
     * sendNewWarrantyClaimMail() helper function to send replace mail.
     */
    private function sendNewWarrantyClaimReplaceMail()
    {
        \Mail::to($this->customerEmail)
            ->send(new \App\Mail\Claim\ReplaceOrder\CustomerMail($this->claim));
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
                ->send(new \App\Mail\Claim\ReplaceOrder\CustomerMail($this->claim));
            $this->repairCenterName = '';
        } elseif($this->claim[0]->ship_to === 'Repair Center') {
            \Mail::to($this->customerEmail)
                ->send(new \App\Mail\Claim\ReplaceOrder\CustomerMail($this->claim));
            \Mail::to($this->repairCenterEmail)
                ->send(new \App\Mail\Claim\ReplaceOrder\RepairCenterMail($this->claim));
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
            ->send(new \App\Mail\Claim\ReplaceOrder\TrackingNumber\CustomerTrackingMail($this->claim));

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
            ->send(new \App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber\CustomerTrackingMail($this->claim));
        \Mail::to($this::RBH_EMAIL)
            ->send(new \App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber\RBHTrackingMail($this->claim, $this->claimComments));

        if($this->claim[0]->ship_to === 'Repair Center') {
            \Mail::to($this->repairCenterEmail)
                ->send(new \App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber\RepairCenterTrackingMail($this->claim));
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
            ->send(new \App\Mail\Claim\RepairOrder\PartRequired\NoPart\RBHNoPartMail($this->claim, $this->claimComments));

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
