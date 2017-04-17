<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\TrackingNumber;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RBHTrackingMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimComments;
    private $claimMessage;
    private $claimType;

    /**
     * RBHTrackingMail constructor.
     *
     * @param $claim
     * @param $claimComments
     */
    public function __construct($claim, $claimComments)
    {
        $this->claim = $claim;
        $this->claimComments = $claimComments;
        $this->claimType = 'Tracking Number';

        if($this->claim[0]->ship_to === 'Customer') {
            $this->claimMessage = 'Part has been shipped to ' . $this->claim[0]->cust_first_name . ' ' . $this->claim[0]->cust_last_name
                . '. The tracking number is #' . $this->claim[0]->tracking_number . '.';
        } elseif($this->claim[0]->ship_to === 'Repair Center') {
            $this->claimMessage = 'Part has been shipped to ' . $this->claim[0]->rc_name
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
        return $this->view('mail.claim.rbh')
            ->subject('Ricardo Beverly Hills - Part Order #' . $this->claim[0]->claim_id . ' Tracking')
            ->with([
                'claim'         => $this->claim,
                'claimComments' => $this->claimComments,
                'claimMessage'  => $this->claimMessage,
                'claimType'     => $this->claimType,
            ]);
    }
}
