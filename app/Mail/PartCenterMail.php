<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartCenterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $claim;
    public $comments;

    /**
     * Create a new PartCenterMail instance.
     *
     * @param $claim
     * @param $comments
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
        return $this->view('mail.part-center')
            ->subject('Ricardo Beverly Hills Part Order Confirmation - Claim #' . $this->claim[0]->claim_id);
    }
}
