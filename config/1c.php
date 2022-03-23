<?php

return [
    'default' => 'orders_sftp',

    'exchangers' => [
        'orders_sftp' => [
            'local_disk_driver' => 'local',
            'local_path' => '1c/',

            'server_disk_driver' => 'sftp',
            'server_path' => '1c/',

            'filename' => 'order.xml',
            
            'db_driver' => 'mongo',
        ],

        'orders_http' => [
            'local_disk_driver' => 'local',
            'local_path' => '1c/',

            'server_disk_driver' => 'http',
            'remote_url' => 'http://laravel/1c/order.xml',

            'filename' => 'order.xml',
            
            'db_driver' => 'mongo',
        ],
    ]
];