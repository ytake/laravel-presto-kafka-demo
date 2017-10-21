<?php
declare(strict_types=1);

namespace Acme\Analysis\Entity;

/**
 * Class AnalysisCollection
 */
final class AnalysisCollection
{
    /** @var array */
    private $records;

    /**
     * AnalysisCollection constructor.
     *
     * @param array $records
     */
    public function __construct(array $records)
    {
        $this->records = $records;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $entities = [];
        foreach ($this->records as $record) {
            $entities[] = new Analysis(
                $record['_key'],
                $record['_value'],
                $record['test_id'],
                $record['test_name'],
                $record['uri'],
                $record['uuid'],
                $record['created_at']
            );
        }

        return $entities;
    }
}
