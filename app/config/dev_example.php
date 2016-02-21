<?php
    /**
     *
     * Config file - Development
     */

    return [
        'app' => [
            'url'   => 'http://localhost', // Your dev base url
            'hash'  => [
                'algo'  => PASSWORD_BCRYPT,
                'cost'  => 10
            ]
        ],
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'your host',
            'name'      => 'your dbname',
            'username'  => 'your username',
            'password'  => 'your password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ],
        'auth' => [
            'session'   => 'user_id',
            'remember'  => 'user_r'
        ],
        'mail' => [
            'secret' => '',
            'domain' => '',
            'form'   => ''
        ],
        'twig' => [
            'debug' => true
        ],
        'csrf' => [
            'session' => 'csrf_token'
        ]
    ];
?>
