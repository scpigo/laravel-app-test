<?php

return [
    'default' => 'orders',

    'exchangers' => [
        'orders' => [
            'local_disk_driver' => 'local',
            'local_path' => '1c/',

            'server_disk_driver' => 'sftp',
            'server_path' => '1c/',

            'filename' => 'order.xml',
            
            'db_driver' => 'mongo',
        ],
        'orders2' => [
            'local_disk_driver' => 'public',
            'local_path' => '2c/',

            'server_disk_driver' => 'post',
            'server_path' => '2c/',

            'filename' => 'order2.xml',
            
            'db_driver' => 'sql',
        ],
    ]
];