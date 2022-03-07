<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tripledes extends Controller
{
    function encryptText_3des($plainText, $key) {
        $key = hash("md5", $key, TRUE);
        for ($x=0;$x<8;$x++) {
            $key = $key.substr($key, $x, 1);
        }
        $padded = pkcs5_pad($plainText,
            mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC));
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_3DES, $key, $padded, MCRYPT_MODE_CBC));
        return $encrypted;
    }
     function pkcs5_pad ($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}
