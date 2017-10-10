<?php
declare(strict_types=1);

namespace App\Foundation\Producer;

use Psr\Log\LoggerInterface;
use RdKafka\Conf;
use RdKafka\Producer as KafkaProducer;
use RdKafka\Producer as RdkafkaProducer;
use RdKafka\ProducerTopic;

/**
 * Class Producer
 */
class Producer
{
    /** @var RdkafkaProducer */
    protected $producer;

    /** @var string */
    protected $topic = 'default';

    /** @var null|LoggerInterface  for optional logger */
    protected $logger;

    /** @var string */
    protected $brokers;

    /** @var array */
    protected $options;

    /**
     * Producer constructor.
     *
     * @param string $topic
     * @param string $brokers
     * @param array  $options
     */
    public function __construct(string $topic, string $brokers, array $options = [])
    {
        $this->topic = $topic;
        $this->brokers = $brokers;
        $this->options = $options;
    }

    /**
     * @param AbstractProduceDefinition $definition
     */
    public function produce(AbstractProduceDefinition $definition)
    {
        $kafkaTopic = $this->producerTopic();
        $kafkaTopic->produce(RD_KAFKA_PARTITION_UA, 0, $definition->payload());
        if ($this->logger instanceof LoggerInterface) {
            $this->logger->info($definition->payload());
        }
        $this->producer->poll(0);
    }

    /**
     * @return ProducerTopic
     */
    protected function producerTopic(): ProducerTopic
    {
        $this->producer = $this->producer();
        $this->producer->setLogLevel(LOG_DEBUG);
        $this->producer->addBrokers($this->brokers);

        return $this->producer->newTopic($this->topic);
    }

    /**
     * @return KafkaProducer
     */
    protected function producer(): KafkaProducer
    {
        $conf = new Conf();
        foreach ($this->options as $key => $item) {
            $conf->set($key, $item);
        }

        return new KafkaProducer($conf);
    }
}
