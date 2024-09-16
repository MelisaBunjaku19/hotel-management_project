<?php
// app/Providers/ElasticsearchServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(\Elastic\Elasticsearch\Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts([env('ELASTICSEARCH_HOST', 'localhost:9200')])
                ->build();
        });
    }
}
