<?php
/** For documentation, see https://github.com/needle-project/laravel-rabbitmq */
return [
    'connections' => [
        'microservice' => [
            'hostname' => env('RABBITMQ_HOST', 'rabbitmq'),
            'port' => env('RABBITMQ_PORT', 5672),
            'username' => env('RABBITMQ_USER', 'guest'),
            'password' => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost' => env('RABBITMQ_VHOST', '/'),
        ]
    ],
    'exchanges' => [
        'microservice-exchange' => [
            'connection' => 'microservice',
            'name' => 'microservice-exchange',
            'attributes' => [
				'exchange_type' => 'topic'
			]
            
        ]
    ],
    'queues' => [
        'microservice-queue' => [
            'connection' => 'microservice',
            'name' => 'microservice',
            'attributes' => [
				'bind' => [
                    ['exchange' => 'microservice', 'routing_key' => '*']
                ]
			]
        ]
    ],
    'publishers' => [
        'microservice-publisher' => 'microservice-queue'
    ],
    'consumers' => [
        'microservice-consumer' => [
            'queue' => 'microservice-queue',
            'message_processor' => \NeedleProject\LaravelRabbitMq\Processor\CliOutputProcessor::class
        ],
        'microservice-consumer_2' => [
            'queue' => 'microservice-queue',
            'message_processor' => \NeedleProject\LaravelRabbitMq\Processor\CliOutputProcessor::class
        ]
    ]
];
