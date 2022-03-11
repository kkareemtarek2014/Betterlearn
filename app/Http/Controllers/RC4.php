<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RC4 extends Controller
{
        private static $S = array();


        private static function swap(&$v1, &$v2)
        {
            $v1 = $v1 ^ $v2;
            $v2 = $v1 ^ $v2;
            $v1 = $v1 ^ $v2;
        }

        private static function KSA($key)
        {
            $idx = crc32($key);
            if (!isset(self::$S[$idx])) {
                $S = range(0, 255);
                $j = 0;
                $n = strlen($key);

                for ($i = 0; $i < 256; $i++) {
                    $char = ord($key{$i % $n});
                    $j = ($j + $S[$i] + $char) % 256;
                    self::swap($S[$i], $S[$j]);
                }
                self::$S[$idx] = $S;
            }
            return self::$S[$idx];
        }



        public static function encrypt($key, $data)
        {
            $S = self::KSA($key);
            $n = strlen($data);
            $i = $j = 0;
            $data = str_split($data, 1);

            for ($m = 0; $m < $n; $m++) {
                $i = ($i + 1) % 256;
                $j = ($j + $S[$i]) % 256;
                self::swap($S[$i], $S[$j]);
                $char = ord($data[$m]);
                $char = $S[($S[$i] + $S[$j]) % 256] ^ $char;
                $data[$m] = chr($char);
            }
            $data = implode('', $data);
            return $data;
        }

        public static function decrypt($key, $data)
        {
            $data = self::encrypt($key, $data);
            return $data;
        }
    }

