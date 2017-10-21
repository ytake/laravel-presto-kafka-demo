<?php
declare(strict_types=1);

namespace App\DataAccess;

use App\Foundation\Consumer\Consumable;
use App\Foundation\Elasticsearch\ElasticseachClient;
use Cake\Chronos\Chronos;
use RdKafka\Message;
use Ytake\PrestoClient\FixData;

/**
 * Class LoggableConsume
 */
final class LoggableConsume implements Consumable
{
    /** @var ElasticseachClient */
    protected $client;

    /** @var string */
    protected $index = 'log.index';

    /** @var Analysis */
    private $analysis;

    /**
     * LoggableConsume constructor.
     *
     * @param Analysis           $analysis
     * @param ElasticseachClient $client
     */
    public function __construct(Analysis $analysis, ElasticseachClient $client)
    {
        $this->analysis = $analysis;
        $this->client = $client;
    }

    /**
     * @param Message $message
     *
     * @return void
     */
    public function __invoke(Message $message)
    {
        $decode = json_decode($message->payload);
        /** @var FixData[] $response */
        $response = $this->analysis->allBy($decode->name);
        if (count($response)) {
            $params = [
                'index' => $this->index,
                'type'  => 'logs',
                'body'  => [
                    '_key'       => $response[0]['_key'],
                    '_value'     => $response[0]['_value'],
                    'test_id'    => $response[0]['test_id'],
                    'test_name'  => $response[0]['test_name'],
                    'created_at' => Chronos::now()->toUnixString(),
                    'uri'        => $response[0]['uri'],
                    'uuid'       => $response[0]['uuid'],
                ],
            ];
            $this->client->client()->index($params);
        }
    }
}
