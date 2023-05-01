<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MailRequest;
use App\Jobs\sendSimpleMail;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MailController extends Controller
{
    /**
     * Send email to user
     **/
    public function sendSimpleEmail(MailRequest $mailRequest)
    {
        try {
            $mailData = $mailRequest->all();
            $sendMail = new sendSimpleMail($mailData);

            $this->dispatch($sendMail);

            return response()->json($mailData, ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
