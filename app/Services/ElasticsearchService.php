<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchService
{
    protected $client;

    public function __construct()
    {
        // Ensure Elasticsearch ClientBuilder class exists
        if (!class_exists(ClientBuilder::class)) {
            throw new \Exception('Elasticsearch ClientBuilder class not found. Please check your Elasticsearch PHP client installation.');
        }

        // Create and configure the client
        $this->client = ClientBuilder::create()
        ->setHosts(['localhost:9200']) // Update this to your Elasticsearch host
        ->build();
    
    }

    // Example method to perform a search query
    public function search($index, $query)
    {
        $params = [
            'index' => $index,
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'prefix' => [
                                    'title' => $query
                                ]
                            ],
                            [
                                'match' => [
                                    'content' => $query
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    
        return $this->client->search($params);
    }
    

    // Example method to index a document
    public function index($index, $id, $document)
    {
        return $this->client->index([
            'index' => $index,
            'id'    => $id,
            'body'  => $document
        ]);
    }
}
