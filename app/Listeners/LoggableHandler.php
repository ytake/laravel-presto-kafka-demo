<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Definition\AnalysisDefinition;
use App\Events\Loggable;
use App\Usecase\MessageProduceUsecase;
use Ramsey\Uuid\Uuid;

/**
 * Class LoggableHandler
 */
class LoggableHandler
{
    /** @var MessageProduceUsecase */
    protected $usecase;

    /**
     * LoggableHandler constructor.
     *
     * @param MessageProduceUsecase $usecase
     */
    public function __construct(MessageProduceUsecase $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * @param Loggable $loggable
     */
    public function handle(Loggable $loggable)
    {
        $this->usecase->run(
            new AnalysisDefinition(Uuid::uuid4()->toString(), $loggable->uri(), $loggable->name())
        );
    }
}
