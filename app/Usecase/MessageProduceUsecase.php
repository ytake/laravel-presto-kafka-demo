<?php
declare(strict_types=1);

namespace App\Usecase;

use App\Definition\AnalysisDefinition;
use App\Foundation\Producer\Producer;

/**
 * Class MessageProduceUsecase
 */
class MessageProduceUsecase
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
