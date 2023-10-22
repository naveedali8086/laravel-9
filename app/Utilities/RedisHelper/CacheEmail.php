<?php

namespace App\Utilities\RedisHelper;

use App\Utilities\Contracts\RedisHelperInterface;
use Illuminate\Support\Facades\Cache;

class CacheEmail implements RedisHelperInterface
{
    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void
    {
        Cache::store('redis')->set(
            "email_$id",
            [
              'email_id' => $id,
              'subject' => $messageSubject,
              'recipient' => $toEmailAddress,
            ]
        );
    }
}
