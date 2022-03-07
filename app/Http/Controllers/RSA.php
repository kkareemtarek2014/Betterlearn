<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RSA extends Controller
{
    public $pubkey = '121212121';
    public $privkey = '131311313';

    public function encrypt($data)
    {
        if (openssl_public_encrypt($data, $encrypted, $this->pubkey))
            $data = base64_encode($encrypted);

        return $data;
    }

    public function decrypt($data)
    {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->privkey))
            $data = $decrypted;

        return $data;
    }}
