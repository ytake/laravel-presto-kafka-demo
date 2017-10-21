<?php
declare(strict_types=1);

namespace App\Foundation\Presto;

use Ytake\PrestoClient\FixData;
use Ytake\PrestoClient\ClientSession;
use Ytake\PrestoClient\ResultsSession;
use Ytake\PrestoClient\StatementClient;

/**
 * Class PrestoClient
 */
class PrestoClient
{
    /** @var ClientSession */
    protected $session;

    /**
     * PrestoClient constructor.
     *
     * @param ClientSession $session
     */
    public function __construct(ClientSession $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $query
     *
     * @return array
     */
    public function query(string $query): array
    {
        $result = [];
        $client = new StatementClient($this->session, $query);
        $resultSession = new ResultsSession($client);
        $yieldResult = $resultSession->execute()->yieldResults();
        /** @var \Ytake\PrestoClient\QueryResult $row */
        foreach ($yieldResult as $row) {
            foreach ($row->yieldData() as $yieldRow) {
                if ($yieldRow instanceof FixData) {
                    $result[] = $yieldRow;
                }
            }
        }

        return $result;
    }
}
