<?php

namespace App\Mail\PartOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWCMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $comments;
    private $note;

    /**
     * Create a new TWCMail instance.
     *
     * @param $claim
     * @param $comments
     */
    public function __construct($claim, $comments)
    {
        $this->claim = $claim;
        $this->comments = $comments;
        $this->note = '';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.part-order.twc')
            ->subject('Ricardo Beverly Hills - Part Order Claim #' . $this->claim[0]->claim_id)
            ->with([
                'claim' => $this->claim,
                'comments' => $this->comments,
                'note' => $this->note,
            ]);
    }
}
