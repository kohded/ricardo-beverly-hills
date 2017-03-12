<?php

namespace App\Models\Mail;

use Illuminate\Support\Facades\DB;

class MailModel
{
    /**
     * Increment email sent counter.
     *
     * @param $claimId
     */
    public function updateEmailSentCounter($claimId)
    {
        DB::table('claim')->whereId($claimId)->increment('email_sent');
    }
}
