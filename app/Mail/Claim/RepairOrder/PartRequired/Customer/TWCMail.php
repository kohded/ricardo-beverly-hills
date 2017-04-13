<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWCMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimComments;
    private $claimMessage;
    private $claimType;

    /**
     * TWCMail constructor.
     *
     * @param $claim
     * @param $claimComments
     */
    public function __construct($claim, $claimComments)
    {
        $this->claim = $claim;
        $this->claimComments = $claimComments;
        $this->claimMessage = 'Please ship part to ' . $this->claim[0]->cust_first_name . ' ' .
            $this->claim[0]->cust_last_name . '.  Customers address is included in the email.';
        $this->claimType = 'Part Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.twc')
            ->subject('Ricardo Beverly Hills - Part Order #' . $this->claim[0]->claim_id)
            ->with([
                'claim'         => $this->claim,
                'claimComments' => $this->claimComments,
                'claimMessage'  => $this->claimMessage,
                'claimType'     => $this->claimType,
            ]);
    }
}
