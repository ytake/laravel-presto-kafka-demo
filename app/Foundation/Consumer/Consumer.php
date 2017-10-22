<?php
declare(strict_types=1);

namespace App\Foundation\Consumer;

use RdKafka\Conf;
use RdKafka\Consumer as KafkaConsumer;
use RdKafka\Message;
use RdKafka\TopicConf;
use RdKafka\ConsumerTopic;

/**
 * Class Consumer
 */
class Consumer
{
    /** @var string */
    protected $topic;

    /** @var \RdKafka\Consumer */
    protected $consumer;

    /** @var int */
    protected $partition = 0;

    /** @var string */
    protected $brokers = '';

    /** @var array */
    protected $configure = [];

    /** @var int */
    protected $offset = RD_KAFKA_OFFSET_STORED;

    protected $callable;

    /**
     * Consumer constructor.
     *
     * @param string $brokers
     * @param array  $configure
     */
    public function __construct(string $brokers, array $configure = [])
    {
        $this->brokers = $brokers;
        $this->configure = $configure;
    }

    /**
     * @param string $topic
     */
    public function topic(string $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @param int $partition
     */
    public function partition(int $partition)
    {
        $this->partition = $partition;
    }

    /**
     * @param int $offset
     */
    public function offset(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param Consumable $callable
     *
     * @throws \Exception
     */
    public function handle(Consumable $callable)
    {
        $topic = $this->consumerTopic();
        $topic->consumeStart($this->partition, $this->offset);
        while (true) {
            $message = $topic->consume($this->partition, 120 * 10000);
            if ($message instanceof Message) {
                switch ($message->err) {
                    case RD_KAFKA_RESP_ERR_NO_ERROR:
                        call_user_func($callable, $message);
                        $this->outputMessage($message);
                        break;
                    case RD_KAFKA_RESP_ERR__TIMED_OUT:
                        throw new \RuntimeException("time out.");
                        break;
                    default:
                        break;
                }
            }
        }
    }

    /**
     * @param callable $callable
     */
    public function callbackMessage(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param Message $message
     */
    protected function outputMessage(Message $message)
    {
        if ($this->callable) {
            call_user_func_array($this->callable, [$message]);
        }
    }

    /**
     * @return ConsumerTopic
     */
    protected function consumerTopic(): ConsumerTopic
    {
        $this->consumer = $this->consumer();
        $this->consumer->addBrokers($this->brokers);

        return $this->consumer->newTopic($this->topic, $this->topicConf());
    }

    /**
     * @return TopicConf
     */
    protected function topicConf(): TopicConf
    {
        $topicConf = new TopicConf();
        $topicConf->set('auto.commit.interval.ms', '100');
        $topicConf->set('offset.store.method', 'file');
        $topicConf->set('offset.store.path', sys_get_temp_dir());
        $topicConf->set('auto.offset.reset', 'smallest');

        return $topicConf;
    }

    /**
     * @return KafkaConsumer
     */
    protected function consumer(): KafkaConsumer
    {
        $conf = new Conf();
        foreach ($this->configure as $key => $item) {
            $conf->set($key, $item);
        }

        return new KafkaConsumer($conf);
    }
}
