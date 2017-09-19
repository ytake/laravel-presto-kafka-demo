<?php
declare(strict_types=1);

namespace App\Usecase;

use App\Definition\Analyze;
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
     * @param Analyze $analyze
     */
    public function run(Analyze $analyze)
    {
        $this->producer->produce($analyze);
    }
}
