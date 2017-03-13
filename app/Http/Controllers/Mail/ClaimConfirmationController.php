<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\ClaimModel;
use App\Models\Mail\MailModel;

class ClaimConfirmationController extends Controller
{
    /**
     * Send claim confirmation email to Ricardo Beverly Hills, part center, and client.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Mail\Mailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMail(
        \Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer)
    {
        $claimModel = new ClaimModel();
        $claimId = $request->input('claim-id');
        $claim = $claimModel->getClaim($claimId);
        $comments = $claimModel->getComments($claimId);

        // CHANGE EMAILS IN PRODUCTION.
        // Ricardo Beverly Hills
        $mailer->to('ricardobevhills@gmail.com')
            ->send(new \App\Mail\RicardoBeverlyHillsMail($claim, $comments));
        // // Part Center
        $mailer->to('ricardobevhills@gmail.com')
            ->send(new \App\Mail\PartCenterMail($claim));
        // // Client
        $mailer->to('ricardobevhills@gmail.com')
            ->send(new \App\Mail\ClientMail($claim));

        $mailModel = new MailModel();
        $mailModel->updateEmailSentCounter($claimId);

        return redirect()->back()->with('message', 'Email sent successfully.');
    }
}
