<?php
declare(strict_types=1);

namespace App\Listeners;

use App\DataAccess\LogProduce;
use App\Definition\AnalysisDefinition;
use App\Events\Loggable;
use Ramsey\Uuid\Uuid;

/**
 * Class LoggableHandler
 */
final class LoggableHandler
{
    /** @var LogProduce */
    protected $producer;

    /**
     * LoggableHandler constructor.
     *
     * @param LogProduce $producer
     */
    public function __construct(LogProduce $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param Loggable $loggable
     */
    public function handle(Loggable $loggable)
    {
        $this->producer->run(
            new AnalysisDefinition(Uuid::uuid4()->toString(), $loggable->uri(), $loggable->name())
        );
    }
}
