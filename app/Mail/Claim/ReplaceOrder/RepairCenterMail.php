<?php

namespace App\Mail\Claim\ReplaceOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RepairCenterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimMessage;
    private $claimPdf;
    private $claimType;

    /**
     * RepairCenterMail constructor.
     *
     * @param $claim
     */
    public function __construct($claim, $claimPdf)
    {
        $this->claim = $claim;
        $this->claimMessage = 'Customer ' . $claim[0]->cust_first_name . ' ' . $claim[0]->cust_last_name .
            '\'s bag will be replaced with a new bag and repair will not be required.';
        $this->claimPdf = $claimPdf;
        $this->claimType = 'Cancel Repair Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.repair-center')
            ->subject('Ricardo Beverly Hills - Cancel Repair Order Claim #' . $this->claim[0]->claim_id)
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
