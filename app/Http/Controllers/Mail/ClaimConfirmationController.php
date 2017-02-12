<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\ClaimModel;

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
        $claim = $claimModel->getClaim($request->input('claim-id'));
        $comments = $claimModel->getComments($request->input('claim-id'));

        // CHANGE EMAILS IN PRODUCTION.
        // Ricardo Beverly Hills
        $mailer->to('ricardobevhills@gmail.com')->send(new \App\Mail\RicardoBeverlyHillsMail($claim, $comments));
        // Part Center
        $mailer->to('ricardobevhills@gmail.com')->send(new \App\Mail\PartCenterMail($claim, $comments));
        // Client
        $mailer->to('ricardobevhills@gmail.com')->send(new \App\Mail\ClientMail($claim));

        return redirect()->back()->with('message', 'Email sent successfully.');
    }
}
