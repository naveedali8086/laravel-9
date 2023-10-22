<?php

namespace App\Providers;

use App\Utilities\Contracts\ElasticsearchHelperInterface;
use App\Utilities\Contracts\RedisHelperInterface;
use App\Utilities\ElasticsearchHelper\StoreEmail;
use App\Utilities\RedisHelper\CacheEmail;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ElasticsearchHelperInterface::class, function ($app) {
            $elasticsearchClient = ClientBuilder::create()->build();
            return new StoreEmail($elasticsearchClient);
        });

        $this->app->bind(RedisHelperInterface::class, CacheEmail::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
