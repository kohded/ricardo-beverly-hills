<?php

namespace App\Mail\Claim\RepairOrder\PartNotRequired\RepairCenter;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimMessage;
    private $claimType;

    /**
     * CustomerMail constructor.
     *
     * @param $claim
     */
    public function __construct($claim)
    {
        $this->claim = $claim;
        $this->claimMessage = $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name .
            ' please bring your bag to ' . $this->claim[0]->rc_name . ' for repair. Address is included in the email.';
        $this->claimType = 'Repair Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.customer')
            ->subject('Ricardo Beverly Hills - Repair Order #' . $this->claim[0]->claim_id)
            ->with([
                'claim'        => $this->claim,
                'claimMessage' => $this->claimMessage,
                'claimType'    => $this->claimType,
            ]);
    }
}
