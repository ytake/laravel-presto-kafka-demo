<?php
declare(strict_types=1);

namespace App\DataAccess;

use Acme\Analysis\Entity\AnalysisCriteria;
use App\Foundation\Elasticsearch\ElasticseachClient;

/**
 * Class LogIndex
 */
class LogIndex implements AnalysisCriteria
{
    /** @var ElasticseachClient */
    protected $client;

    /** @var string */
    protected $index = 'log.index';

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
            'index' => $this->index,
            'type'  => 'logs',
            "size" => 50,
            'body'  => [
                "query" => [
                    'match_all' => new \stdClass(),
                ],
                'sort'  => [
                    'created_at' => [
                        'order' => 'desc',
                    ],
                ],
            ],
        ]);
        $map = [];
        if (count($result)) {
            foreach ($result['hits']['hits'] as $hit) {
                $map[] = $hit['_source'];
            }
        }

        return $map;
    }
}
