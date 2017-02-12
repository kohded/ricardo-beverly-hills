<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\ClaimModel;

class ClaimConfirmationController extends Controller
{
    /**
     * Send claim confirmation email to part center, client, and Ricardo Beverly Hills.
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
        // Mail to part center.
        $mailer->to('ricardobevhills@gmail.com')->send(new \App\Mail\PartCenterMail($claim, $comments));

        return redirect()->back();
    }
}
