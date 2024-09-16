<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Log;
use Exception;

class ElasticsearchService
{
    protected $client;

    public function __construct()
    {
        if (!class_exists(ClientBuilder::class)) {
            throw new \Exception('Elasticsearch ClientBuilder class not found. Please check your Elasticsearch PHP client installation.');
        }

        $hosts = [env('ELASTICSEARCH_HOST', 'localhost:9200')];
        $user = env('ELASTICSEARCH_USER');
        $password = env('ELASTICSEARCH_PASSWORD');

        $this->client = ClientBuilder::create()
            ->setHosts($hosts)
            ->setBasicAuthentication($user, $password)
            ->build();
    }

    /**
     * Search for rooms.
     *
     * @param string $query
     * @param int $from
     * @param int $size
     * @param array $filters
     * @return array
     */
    public function searchRooms($query, $from = 0, $size = 10, $filters = [])
    {
        // Ensure $query is a string
        $query = is_array($query) ? implode(' ', $query) : (string)$query;

        // Build the must queries
        $mustQueries = [
            [
                'wildcard' => [
                    'room_title' => [
                        'value' => strtolower($query) . '*', // For partial matching in room title
                        'boost' => 1.0,
                        'rewrite' => 'constant_score'
                    ]
                ]
            ],
            [
                'wildcard' => [
                    'description' => [
                        'value' => strtolower($query) . '*', // For partial matching in description
                        'boost' => 0.5,
                        'rewrite' => 'constant_score'
                    ]
                ]
            ]
        ];

        // Build the filter queries
        $filterQueries = [];

        // Filter by room type
        if (!empty($filters['room_type'])) {
            $filterQueries[] = [
                'term' => [
                    'room_type' => $filters['room_type']
                ]
            ];
        }

        // Filter by price range
        if (isset($filters['price']) && is_array($filters['price'])) {
            $priceRange = $filters['price'];
            $filterQueries[] = [
                'range' => [
                    'price' => [
                        'gte' => $priceRange['min'] ?? 0,
                        'lte' => $priceRange['max'] ?? null
                    ]
                ]
            ];
        }

        // Filter by wifi availability
        if (isset($filters['wifi'])) {
            $filterQueries[] = [
                'term' => [
                    'wifi' => $filters['wifi']
                ]
            ];
        }

        // Assemble the search parameters
        $params = [
            'index' => env('ELASTICSEARCH_INDEX', 'rooms'),
            'body'  => [
                'from' => $from,
                'size' => $size,
                'query' => [
                    'bool' => [
                        'must' => $mustQueries,
                        'filter' => [
                            'bool' => [
                                'must' => $filterQueries
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Execute the search query
        try {
            $response = $this->client->search($params);

            if (isset($response['hits']['hits'])) {
                return $response;
            } else {
                return ['hits' => ['hits' => []]];
            }
        } catch (Exception $e) {
            Log::error('Elasticsearch search failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'params' => $params
            ]);
            throw new \Exception('Search query failed: ' . $e->getMessage());
        }
    }
}
