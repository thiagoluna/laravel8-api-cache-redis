<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\MailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    private MailService $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function sendWelcomeEmail(Request $request)
    {
        $this->mailService->sendWelcomeEmail($request->all());
    }
}
