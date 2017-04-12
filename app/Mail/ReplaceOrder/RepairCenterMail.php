<?php

namespace App\Mail\ReplaceOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RepairCenterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $note;

    /**
     * Create a new RepairCenterMail instance.
     *
     * @param $claim
     */
    public function __construct($claim)
    {
        $this->claim = $claim;
        $this->note = 'Customer ' . $claim[0]->cust_first_name . ' ' . $claim[0]->cust_last_name .
            '\'s bag will be replaced with a new bag and repair will not be required.';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.replace-order.repair-center')
            ->subject('Ricardo Beverly Hills - Replace Order Claim #' . $this->claim[0]->claim_id)
            ->with([
                'claim' => $this->claim,
                'note'  => $this->note,
            ]);
    }
}
