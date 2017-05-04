<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerTrackingMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimMessage;
    private $claimPdf;
    private $claimType;

    /**
     * CustomerTrackingMail constructor.
     *
     * @param $claim
     */
    public function __construct($claim, $claimPdf)
    {
        $this->claim = $claim;
        $this->claimType = 'Tracking Number';
        $this->claimPdf = $claimPdf;

        if($this->claim[0]->ship_to === 'Customer') {
            $this->claimMessage = 'Your part has been shipped to the address in your claim. The tracking number is #' . $this->claim[0]->tracking_number . '.';
        } elseif($this->claim[0]->ship_to === 'Repair Center') {
            $this->claimMessage = 'Your part has been shipped to ' . $this->claim[0]->rc_name
                . '. The tracking number is #' . $this->claim[0]->tracking_number . '.';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.customer')
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
