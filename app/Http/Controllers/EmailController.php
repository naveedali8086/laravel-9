<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkEmailRequest;
use App\Jobs\BulkEmailJob;
use App\Models\Email;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use App\Utilities\Contracts\RedisHelperInterface;

class EmailController extends Controller
{
    // TODO: finish implementing send method
    public function send(
        BulkEmailRequest $request,
        ElasticsearchHelperInterface $elasticsearchHelper,
        RedisHelperInterface $redisHelper
    ) {
        $emails = $request->input('emails');

        foreach ($emails as $email_obj) {

            $email = Email::query()->create($email_obj);

            // store email in elasticsearch
            $elasticsearchHelper->storeEmail(
                $email->body,
                $email->subject,
                $email->recipient
            );

            // cache email in redis
             $redisHelper->storeRecentMessage(
                 $email->id,
                 $email->subject,
                 $email->recipient
             );

            // dispatch job to send bulk emails to recipient
            BulkEmailJob::dispatch($email);
        }

        // as per the convention, when a resource is newly created "201" http code is returned
        return response()->json(['message' => 'Emails saved'], 201);
    }

    //  TODO - BONUS: implement list method
    public function list()
    {
        // as per the requirements, only following three attributes were requested to be sent in response
        return Email::query()->select(['recipient', 'subject', 'body'])->simplePaginate();
    }
}
