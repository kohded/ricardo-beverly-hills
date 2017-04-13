<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\Customer;

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
    private $claimType;

    /**
     * RBHMail constructor.
     *
     * @param $claim
     * @param $claimComments
     */
    public function __construct($claim, $claimComments)
    {
        $this->claim = $claim;
        $this->claimComments = $claimComments;
        $this->claimMessage = $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name .
            ' part will be shipped to their address provided with the claim.';
        $this->claimType = 'Part Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.rbh')
            ->subject('Ricardo Beverly Hills - Part Order #' . $this->claim[0]->claim_id)
            ->with([
                'claim'         => $this->claim,
                'claimComments' => $this->claimComments,
                'claimMessage'  => $this->claimMessage,
                'claimType'     => $this->claimType,
            ]);
    }
}
