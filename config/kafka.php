<?php

return [
    'topics'   => [
        'analyze.action'    => [
            'topic'   => 'analyze.action',
            'brokers' => '127.0.0.1',
            'options' => [
                'socket.blocking.max.ms'       => '1',
                'queue.buffering.max.ms'       => '1',
                'queue.buffering.max.messages' => '1000',
                'client.id'                    => 'testingClient',
            ],
        ],
        'fulltext.register' => [
            'topic'   => 'fulltext.register',
            'brokers' => '127.0.0.1',
            'options' => [
                'socket.blocking.max.ms'       => '1',
                'queue.buffering.max.ms'       => '1',
                'queue.buffering.max.messages' => '1000',
                'client.id'                    => 'testingClient',
            ],
        ],
    ],
    'consumer' => [
        'brokers' => '127.0.0.1',
        'options' => [
            'heartbeat.interval.ms'              => '10000',
            'session.timeout.ms'                 => '30000',
            'topic.metadata.refresh.interval.ms' => '60000',
            'topic.metadata.refresh.sparse'      => 'true',
            'log.connection.close'               => 'false',
            'group.id'                           => 'testingConsumer',
        ],
    ],
];
