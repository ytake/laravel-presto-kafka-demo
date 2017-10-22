<?php
declare(strict_types=1);

namespace App\Console;

use App\Foundation\Consumer\Consumable;
use App\Foundation\Consumer\Consumer;
use Illuminate\Console\Command;
use RdKafka\Message;

/**
 * Class ConsumerCommand
 */
class ConsumerCommand extends Command
{
    /** @var string */
    protected $name = 'kafka:consumer';

    /** @var string */
    protected $description = '';

    /** @var Consumer */
    protected $consumer;

    /** @var string */
    protected $topic;

    /** @var Consumable */
    protected $consumable;

    /**
     * ConsumerCommand constructor.
     *
     * @param Consumer   $consumer
     * @param Consumable $consumable
     * @param string     $topic
     */
    public function __construct(
        Consumer $consumer,
        Consumable $consumable,
        string $topic = 'analyze.action'
    ) {
        parent::__construct();
        $this->consumer = $consumer;
        $this->consumable = $consumable;
        $this->topic = $topic;
    }

    public function handle()
    {
        $this->consumer->topic($this->topic);
        $this->consumer->callbackMessage(function (Message $message) {
            $this->info($message->payload);
        });
        $this->consumer->handle($this->consumable);
    }
}
