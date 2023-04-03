<?php

namespace System\Src;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    protected $key;
    protected $payload;

    public function __construct()
    {
        $this->key = $_ENV['APP_KEY'];
        $this->payload = [
            'iss' => $_ENV['BASE_URL'],
            'aud' => $_ENV['BASE_URL'],
            'iat' => time(),
            'exp' => time() + 3600
        ];
    }

    public function get($data = [])
    {
        return JWT::encode(array_merge($this->payload, $data), $this->key, 'HS256');
    }
}