<?php

namespace App\Models\Mail;

class MailClaimModel
{
    /**
     * Increment email sent count.
     *
     * @param $claimId
     */
    public function incrementEmailSentCount($claimId)
    {
        \DB::table('claim')->whereId($claimId)->increment('email_sent');
    }
}
