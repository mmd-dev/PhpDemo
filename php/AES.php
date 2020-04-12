<?php
class AES {
    static function encrypt($data, $key) {
        $data = openssl_encrypt($data, 'aes-128-ecb', hex2bin($key), OPENSSL_RAW_DATA);
        return strtoupper(bin2hex($data));
    }

    static function decrypt($data, $key) {
        $binData = hex2bin($data);
        $decryptData = openssl_decrypt($binData, 'aes-128-ecb', hex2bin($key), OPENSSL_RAW_DATA);
        return $decryptData;
    }
}
