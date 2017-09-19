<?php
declare(strict_types=1);

namespace App\Repository;

use App\Foundation\Presto\AnalysisMapper;
use App\Foundation\Presto\PrestoClient;

/**
 * Class AnalysisRepository
 */
final class AnalysisRepository
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
     * @return AnalysisMapper[]
     */
    public function findAll(): array
    {
        $query = "SELECT redttt._key, redttt._value, test_id, test_name, created_at, uri, uuid 
              FROM my_tests.testing.tests AS myttt 
              INNER JOIN red_tests.test.string AS redttt ON redttt._key = myttt.test_name 
              INNER JOIN kafka_tests.analyze.action AS kafkataa ON kafkataa.name = myttt.test_name
              WHERE myttt.test_name = 'presto'";
        return $this->client->query($query, AnalysisMapper::class);
    }
}