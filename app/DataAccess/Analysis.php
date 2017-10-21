<?php
declare(strict_types=1);

namespace App\DataAccess;

use App\Foundation\Presto\PrestoClient;

/**
 * Class Analysis
 */
final class Analysis
{
    /** @var PrestoClient */
    protected $client;

    /**
     * AnalysisRepository constructor.
     *
     * @param PrestoClient $client
     */
    public function __construct(PrestoClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $name
     * @return array
     */
    public function allBy(string $name): array
    {
        $query = "SELECT redttt._key, redttt._value, test_id, test_name, created_at, uri, uuid 
              FROM my_tests.testing.tests AS myttt 
              INNER JOIN red_tests.test.string AS redttt ON redttt._key = myttt.test_name 
              INNER JOIN kafka_tests.analyze.action AS kafkataa ON kafkataa.name = myttt.test_name
              WHERE myttt.test_name = '{$name}' LIMIT 1";
        return $this->client->query($query);
    }
}
