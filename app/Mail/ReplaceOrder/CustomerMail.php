<?php

namespace App\Mail\ReplaceOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $note;

    /**
     * Create a new CustomerMail instance.
     *
     * @param $claim
     */
    public function __construct($claim)
    {
        $this->claim = $claim;
        $this->note = 'Your warranty claim has been processed and a replacement bag will be sent to 
        the address you provide with your claim.';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.replace-order.customer')
            ->subject('Ricardo Beverly Hills - Replace Order Claim #' . $this->claim[0]->claim_id)
            ->with([
                'claim' => $this->claim,
                'note'  => $this->note,
            ]);
    }
}
