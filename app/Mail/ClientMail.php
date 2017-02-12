<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $claim;

    /**
     * Create a new ClientMail instance.
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
        return $this->view('mail.client')
            ->subject('Ricardo Beverly Hills Part Order Confirmation - Claim #' . $this->claim[0]->claim_id);
    }
}
