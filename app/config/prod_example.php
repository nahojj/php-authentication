<?php
    /**
     *
     * Config file - Production
     */

    return [
        'app' => [
            'url'   => 'http://localhost', // Base domain url
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
            'smpt_auht'     => true,
            'smpt_secure'   => 'tls',
            'host'          => 'smtp.gmail.com',
            'username'      => 'youraccount@gmail.com',
            'password'      => 'yourpassword',
            'port'          => 587,
            'html'          => true
        ],
        'twig' => [
            'debug' => true
        ],
        'csrf' => [
            'session' => 'csrf_token'
        ]
    ];
?>
