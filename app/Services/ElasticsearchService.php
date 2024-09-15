<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Log; // Import Log class for logging errors
use Exception; // Import Exception class

class ElasticsearchService
{
    protected $client;

    public function __construct()
    {
        if (!class_exists(ClientBuilder::class)) {
            throw new \Exception('Elasticsearch ClientBuilder class not found. Please check your Elasticsearch PHP client installation.');
        }

        $this->client = ClientBuilder::create()
        ->setHosts([env('ELASTICSEARCH_HOST', 'localhost:9200')])
        ->setBasicAuthentication(
            env('ELASTICSEARCH_USER', 'elastic'), 
            env('ELASTICSEARCH_PASSWORD', '12345678')
        )
        ->build();
    
    }

    
    public function search($query, $index = 'blogs', $from = 0, $size = 10)
    {
        $params = [
            'index' => $index,
            'body'  => [
                'from' => $from,
                'size' => $size,
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'wildcard' => [
                                    'title' => [
                                        'value' => strtolower($query) . '*', // For partial matching
                                        'boost' => 1.0,
                                        'rewrite' => 'constant_score'
                                    ]
                                ]
                            ],
                            [
                                'wildcard' => [
                                    'content' => [
                                        'value' => strtolower($query) . '*', // For partial matching in content
                                        'boost' => 0.5,
                                        'rewrite' => 'constant_score'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    
        try {
            $response = $this->client->search($params);
    
            if (isset($response['hits']['hits'])) {
                return $response;
            } else {
                return ['hits' => ['hits' => []]];
            }
        } catch (Exception $e) {
            Log::error('Elasticsearch search failed', ['error' => $e->getMessage()]);
            throw new \Exception('Search query failed: ' . $e->getMessage());
        }
    }
}    