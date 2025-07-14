<?php
function decrypt($data, $key = "tranviethung0712")
{
    $data = base64_decode($data);
    $iv = substr($data, 0, 16);
    $encrypted = substr($data, 16);
    return openssl_decrypt($encrypted, 'AES-128-CBC', $key, 0, $iv);
}
