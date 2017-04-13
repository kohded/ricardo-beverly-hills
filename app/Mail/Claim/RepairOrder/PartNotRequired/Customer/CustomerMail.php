<?php

namespace App\Mail\Claim\RepairOrder\PartNotRequired\Customer;

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
        $this->claimMessage =  $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name .
            ' did not require any parts or repair, your claim will be closed.';
        $this->claimType = 'Claim Closed';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.customer')
            ->subject('Ricardo Beverly Hills - Claim Closed #' . $this->claim[0]->claim_id)
            ->with([
                'claim'        => $this->claim,
                'claimMessage' => $this->claimMessage,
                'claimType'    => $this->claimType,
            ]);
    }
}
