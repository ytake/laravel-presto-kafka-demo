<?php

return [
    'topics'   => [
        'analyze.action' => [
            'topic'   => 'analyze.action',
            'brokers' => '127.0.0.1',
            'options' => [
                'socket.blocking.max.ms'       => '1',
                'queue.buffering.max.ms'       => '1',
                'queue.buffering.max.messages' => '1000',
                'client.id'                    => 'testingClient',
            ],
        ],
    ],
];
