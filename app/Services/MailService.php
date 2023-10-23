<?php

namespace App\Services;

use App\Jobs\SendWelcomeEmailJob;

class MailService
{
    public function sendWelcomeEmail(array $mailData)
    {
        SendWelcomeEmailJob::dispatch($mailData);
    }
}
