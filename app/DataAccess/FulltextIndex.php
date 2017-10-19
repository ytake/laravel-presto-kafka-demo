<?php
declare(strict_types=1);

namespace App\DataAccess;

use App\DataAccess\DataMapper\FulltextMapper;
use App\Foundation\Elasticsearch\ElasticseachClient;

/**
 * Class FulltextIndex
 */
class FulltextIndex
{
    /** @var ElasticseachClient */
    protected $client;

    /** @var string */
    protected $index = 'fulltext.register';

    /**
     * FulltextIndex constructor.
     *
     * @param ElasticseachClient $client
     */
    public function __construct(ElasticseachClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return FulltextMapper[]
     */
    public function all(): array
    {
        $result = $this->client->client()->search([
            "index"  => $this->index,
            'type'   => 'kafka-connect',
            "body"   => [
                "query" => [
                    "match_all" => new \stdClass(),
                ],
            ],
        ]);
        $map = [];
        if (count($result)) {
            foreach($result['hits']['hits'] as $hit) {
                $map[] = new FulltextMapper($hit['_source']['text'], $hit['_source']['uuid']);
            }
        }

        return $map;
    }
}
