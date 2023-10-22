<?php

namespace App\Utilities\ElasticsearchHelper;

use App\Utilities\Contracts\ElasticsearchHelperInterface;
use Elastic\Elasticsearch\Client;

class StoreEmail implements ElasticsearchHelperInterface
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): mixed
    {
        return $this->elasticsearch->index([
            'index' => 'emails',
            'body' => [
                'body' => $messageBody,
                'subject' => $messageSubject,
                'recipient' => $toEmailAddress,
            ]
        ]);
    }
}
