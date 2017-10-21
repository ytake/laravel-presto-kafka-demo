<?php
declare(strict_types=1);

namespace App\DataAccess;

use App\Foundation\Producer\Producer;
use App\Foundation\Producer\AbstractProduceDefinition;

/**
 * Class AbstractProduce
 */
abstract class AbstractProduce
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
     * @param AbstractProduceDefinition $analyze
     */
    public function run(AbstractProduceDefinition $analyze)
    {
        $this->producer->produce($analyze);
    }
}
