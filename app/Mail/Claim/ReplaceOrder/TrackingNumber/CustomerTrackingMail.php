<?php

namespace App\Mail\Claim\ReplaceOrder\TrackingNumber;

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
        $this->claimMessage = 'Your replacement bag has been shipped. The tracking number is #' . $this->claim[0]->tracking_number . '.';
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
        return $this->view('mail.claim.customer')
            ->subject('Ricardo Beverly Hills - Replace Order #' . $this->claim[0]->claim_id . ' Tracking')
            ->with([
                'claim'        => $this->claim,
                'claimMessage' => $this->claimMessage,
                'claimType'    => $this->claimType,
            ])
            ->attachData($this->claimPdf, 'Replace Order ' . $this->claim[0]->claim_id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
