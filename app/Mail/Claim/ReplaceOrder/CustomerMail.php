<?php

namespace App\Mail\Claim\ReplaceOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimPdf;
    private $claimMessage;
    private $claimType;

    /**
     * CustomerMail constructor.
     *
     * @param $claim
     */
    public function __construct($claim, $claimPdf)
    {
        $this->claim = $claim;
        $this->claimMessage = 'Your warranty claim has been processed and a replacement bag will be 
            sent to the address you provide with your claim. You will receive an email with a 
            tracking number when the bag ships.';
        $this->claimPdf = $claimPdf;
        $this->claimType = 'Replace Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.customer')
            ->subject('Ricardo Beverly Hills - Replace Order Claim #' . $this->claim[0]->claim_id)
            ->with([
                'claim'        => $this->claim,
                'claimMessage' => $this->claimMessage,
                'claimType'    => $this->claimType,
            ])
            ->attachData($this->claimPdf, $this->claimType . ' ' . $this->claim[0]->claim_id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
