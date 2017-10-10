<?php
declare(strict_types=1);

namespace App\DataAccess;

use App\Definition\AnalysisDefinition;
use App\Foundation\Producer\Producer;

/**
 * Class LogProduce
 */
final class LogProduce
{
    /** @var Producer */
    protected $producer;

    /**
     * MessageProduceUsecase constructor.
     *
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param AnalysisDefinition $analyze
     */
    public function run(AnalysisDefinition $analyze)
    {
        $this->producer->produce($analyze);
    }
}
