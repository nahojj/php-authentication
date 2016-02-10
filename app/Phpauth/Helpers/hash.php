<?php

namespace Phpauth\Helpers;

Class Hash {
    protected $confing;

    public function __construct($config) {
        $this->config = $config;
    }

    public function password($password) {
        return password_hash(
            $password,
            $this->config->get('app.hash.algo'),
            ['cost' => $this->config->get('app.hash.cost')]
        );
    }

    public function passwordCheck($password, $hash) {
        return password_verify($password, $hash);
    }

    public function hash($value) {
        return hash('sha256', $value);
    }

    public function hashCeck($know, $user) {
        return hash_equals($know, $user);
    }
}

?>
