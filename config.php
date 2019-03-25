<?php
    return[
        'db' => [
            'connection' => 'mysql:host=localhost',
            'db' => 'rexx_test',
            'user' => 'root',
            'password' => 'root',
            'options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        ]
    ];
