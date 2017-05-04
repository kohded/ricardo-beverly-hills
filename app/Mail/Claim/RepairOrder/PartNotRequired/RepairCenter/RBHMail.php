<?php

namespace App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RBHMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimComments;
    private $claimMessage;
    private $claimPdf;
    private $claimType;

    /**
     * RBHMail constructor.
     *
     * @param $claim
     * @param $claimComments
     */
    public function __construct($claim, $claimComments, $claimPdf)
    {
        $this->claim = $claim;
        $this->claimComments = $claimComments;
        $this->claimMessage = $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name .
            ' will be bringing there bag to ' . $this->claim[0]->rc_name . ' for repair, no parts required.';
        $this->claimPdf = $claimPdf;
        $this->claimType = 'Repair Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.rbh')
            ->subject('Ricardo Beverly Hills - Repair Order #' . $this->claim[0]->claim_id)
            ->with([
                'claim'         => $this->claim,
                'claimComments' => $this->claimComments,
                'claimMessage'  => $this->claimMessage,
                'claimType'     => $this->claimType,
            ])
            ->attachData($this->claimPdf, $this->claimType . ' ' . $this->claim[0]->claim_id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
