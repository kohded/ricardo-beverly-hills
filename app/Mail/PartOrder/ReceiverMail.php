<?php

namespace App\Mail\PartOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceiverMail extends Mailable
{
    use Queueable, SerializesModels;

    public $claim;

    /**
     * Create a new ReceiverMail instance.
     *
     * @param $claim
     */
    public function __construct($claim)
    {
        $this->claim = $claim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.part-order.receiver')
            ->subject('Ricardo Beverly Hills - Part Order Claim #' . $this->claim[0]->claim_id);
    }
}
