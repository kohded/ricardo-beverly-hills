<?php

namespace App\Mail\Claim\RepairOrder\PartRequired\Customer;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TWCMail extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;
    private $claimComments;
    private $claimMessage;
    private $claimPdf;
    private $claimType;
    private $packingSlipPdf;
    private $partOrderPdf;

    /**
     * TWCMail constructor.
     *
     * @param $claim
     * @param $claimComments
     */
    public function __construct($claim, $claimComments, $claimPdf)
    {
        $this->claim = $claim;
        $this->claimComments = $claimComments;
        $this->claimMessage = 'Please ship part to ' . $this->claim[0]->cust_first_name . ' ' .
            $this->claim[0]->cust_last_name . '.  Customers address is included in the email.';
        $this->claimPdf = $claimPdf;
        $this->claimType = 'Part Order';
        $this->packingSlipPdf = PDF::loadView('pdf.packing-slip', ['claim' => $this->claim])->download();
        $this->partOrderPdf = PDF::loadView('pdf.part-order', ['claim' => $this->claim])->download();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.claim.twc')
            ->subject('Ricardo Beverly Hills - Part Order #' . $this->claim[0]->claim_id)
            ->with([
                'claim'         => $this->claim,
                'claimComments' => $this->claimComments,
                'claimMessage'  => $this->claimMessage,
                'claimType'     => $this->claimType,
            ])
            ->attachData($this->packingSlipPdf, 'Packing Slip ' . $this->claim[0]->claim_id . '.pdf', [
                'mime' => 'application/pdf',
            ])
            ->attachData($this->partOrderPdf, 'Part Order ' . $this->claim[0]->claim_id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
