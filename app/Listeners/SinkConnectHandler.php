<?php
declare(strict_types=1);

namespace App\Listeners;

use Ramsey\Uuid\Uuid;
use App\Events\SinkConnect;
use App\DataAccess\RegisterProduce;
use App\Definition\FulltextDefinition;

/**
 * Class SinkConnectHandler
 */
final class SinkConnectHandler
{
    /** @var RegisterProduce */
    protected $producer;

    /**
     * SinkConnectHandler constructor.
     *
     * @param RegisterProduce $producer
     */
    public function __construct(RegisterProduce $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param SinkConnect $connect
     */
    public function handle(SinkConnect $connect)
    {
        $this->producer->run(
            new FulltextDefinition(Uuid::uuid4()->toString(), $connect->note())
        );
    }
}
