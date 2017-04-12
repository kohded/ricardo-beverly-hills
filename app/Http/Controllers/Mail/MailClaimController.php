<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\ClaimModel;
use App\Models\Mail\MailClaimModel;

class MailClaimController extends Controller
{
    private const RBH_EMAIL = 'ricardobevhills@gmail.com';
    // REPLACE WITH TWC EMAIL IN PRODUCTION.
    private const TWC_EMAIL = 'ricardobevhills@gmail.com';
    private $receiverEmail;
    private $claim;
    private $comments;

    /**
     * Send email to RBH, TWC, and receiver.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(\Illuminate\Http\Request $request)
    {
        $claimModel = new ClaimModel();
        $claimId = $request->input('claim-id');
        $this->claim = $claimModel->getClaim($claimId);
        $this->comments = $claimModel->getComments($claimId);
        $receiverName = '';

        // Set receiver email and name.
        switch($this->claim[0]->ship_to) {
            case 'Repair Center':
                $this->receiverEmail = $this->claim[0]->rc_email;
                $receiverName = $this->claim[0]->rc_name;
                break;
            case 'Customer':
                $this->receiverEmail = $this->claim[0]->cust_email;
                $receiverName = $this->claim[0]->cust_first_name . $this->claim[0]->cust_last_name;
                break;
            default:
                $this->receiverEmail = $this::RBH_EMAIL;
                $receiverName = 'Sorry, there was no ship to recipient for this claim. RBH will be 
                                sent an additional email for this claim.';
                break;
        }

        // DELETE THIS LINE IN PRODUCTION ONLY.
        $this->receiverEmail = 'ricardobevhills@gmail.com';

        // Send part order email or replace order email.
        switch($this->claim[0]->replaced) {
            case 0:
                $this->partOrderMail();
                break;
            default:
                break;
        }

        // Increment email sent count for claim.
        $mailModel = new MailClaimModel();
        $mailModel->incrementEmailSentCount($claimId);

        // Redirect with email message.
        return redirect()->back()->with('email-message', [
            'message'  => 'Email sent successfully to:',
            'rbh'      => 'Ricardo Beverly Hills',
            'twc'      => 'T.W. Carrol & Co.',
            'receiver' => $receiverName,
        ]);
    }

    /**
     * Send email to RBH, TWC, and receiver for part order.
     */
    public function partOrderMail()
    {
        // Ricardo Beverly Hills
        \Mail::to($this::RBH_EMAIL)
            ->send(new \App\Mail\PartOrder\RBHMail($this->claim, $this->comments));
        // Part Center
        \Mail::to($this::TWC_EMAIL)
            ->send(new \App\Mail\PartOrder\TWCMail($this->claim, $this->comments));
        // Receiver
        \Mail::to($this->receiverEmail)
            ->send(new \App\Mail\PartOrder\ReceiverMail($this->claim));
    }
}
