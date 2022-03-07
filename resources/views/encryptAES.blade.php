@extends('layout')
@section('content')

<?php


      function encrypt($string, $key)
    {
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        // Lengths in bytes:
        $key_length = (int) ($this->_nKeySize / 8);
        $block_length = 16;
        // 128 bits, iv has the same length.
        // $salted_length = $key_length (32, 24, 16) + $block_length (16) = (48, 40, 32)
        $salted_length = $key_length + $block_length;
        while (strlen($salted) < $salted_length) {
            $dx = md5($dx . $key . $salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, $key_length);
        $iv = substr($salted, $key_length, $block_length);
        return base64_encode('Salted__' . $salt . openssl_encrypt($string, "aes-" . $this->_nKeySize . "-cbc", $key, true, $iv));
    }?>



@endsection
