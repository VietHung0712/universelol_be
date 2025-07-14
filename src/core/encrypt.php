<?php
function encrypt($data, $key = "tranviethung0712")
{
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted = openssl_encrypt($data, 'AES-128-CBC', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}
