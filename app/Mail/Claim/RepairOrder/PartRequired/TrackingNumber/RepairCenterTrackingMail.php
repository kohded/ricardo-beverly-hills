<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RepairCenterTrackingMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimMessage;
    private $claimPdf;
    private $claimType;

    /**
     * RepairCenterTrackingMail constructor.
     *
     * @param $claim
     */
    public function __construct($claim, $claimPdf)
    {
        $this->claim = $claim;
        $this->claimMessage = $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name
            . '\'s part has been shipped. The tracking number is #' . $this->claim[0]->tracking_number . '.';
        $this->claimPdf = $claimPdf;
        $this->claimType = 'Tracking Number';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.repair-center')
            ->subject('Ricardo Beverly Hills - Part Order #' . $this->claim[0]->claim_id . ' Tracking')
            ->with([
                'claim'        => $this->claim,
                'claimMessage' => $this->claimMessage,
                'claimType'    => $this->claimType,
            ])
            ->attachData($this->claimPdf, $this->claimType . ' - Repair Order ' . $this->claim[0]->claim_id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
