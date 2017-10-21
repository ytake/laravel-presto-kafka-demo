<?php
declare(strict_types=1);

namespace App\DataAccess;

use Acme\Blog\Entity\EntryCriteria;
use App\Foundation\Elasticsearch\ElasticseachClient;

/**
 * Class FulltextIndex
 */
class FulltextIndex implements EntryCriteria
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
     * @return array
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
                $map[] = $hit['_source'];
            }
        }

        return $map;
    }

    public function queryBy(string $string)
    {
        // TODO: Implement queryBy() method.
    }
}
