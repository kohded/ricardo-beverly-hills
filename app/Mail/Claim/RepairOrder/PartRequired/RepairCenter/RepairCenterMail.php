<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\RepairCenter;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RepairCenterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimMessage;
    private $claimType;

    /**
     * RepairCenterMail constructor.
     *
     * @param $claim
     */
    public function __construct($claim)
    {
        $this->claim = $claim;
        $this->claimMessage = $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name .
            ' will be bringing in there bag for repair. TWC has been notified for part order.';
        $this->claimType = 'Repair Order';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.repair-center')
            ->subject('Ricardo Beverly Hills - Repair Order #' . $this->claim[0]->claim_id)
            ->with([
                'claim'        => $this->claim,
                'claimMessage' => $this->claimMessage,
                'claimType'    => $this->claimType,
            ]);
    }
}
