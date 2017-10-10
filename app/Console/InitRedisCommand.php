<?php
declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Redis\RedisManager;

/**
 * Class InitRedisCommand
 */
class InitRedisCommand extends Command
{
    /** @var string */
    protected $name = 'init:redis';

    /** @var string */
    protected $description = '';

    /** @var RedisManager */
    protected $manager;

    protected $initialize = [
        'presto'        => 'https://prestodb.io/',
        'kafka'         => 'https://kafka.apache.org/',
        'laravel'       => 'https://laravel.com/',
        'elasticsearch' => 'https://www.elastic.co/jp/products/elasticsearch',
    ];

    /**
     * InitRedisCommand constructor.
     *
     * @param RedisManager $manager
     */
    public function __construct(RedisManager $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function handle()
    {
        $connect = $this->manager->connection();
        foreach ($this->initialize as $key => $value) {
            $connect->set($key, $value);
        }
    }
}
