<?php
/**
 * Try real hard to get the client IP.
 * @return string|boolean  Either the client IP or FALSE.
 */
function getClientIP() {
    $ip = FALSE;
    if (isset($_SERVER['REMOTE_ADDR']))          $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_CLIENT_IP']))       $ip = $_SERVER['HTTP_CLIENT_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    // HTTP_X_FORWARDED_FOR usually contains more than one ip: client, proxy1, proxy2, ..., but we only want the client ip.
    if (strstr($ip, ',')) {
        $dump = explode(',', $ip);
        if (is_array($dump) && isset($dump[0])) {
            $ip = trim($dump[0]);
        }
    }
    return $ip;
}

/**
 * Encode data to JSON.
 * @param mixed $data  Input to encode.
 * @param  mixed $flags  JSON flags to apply.
 * @return string  Enccoded data.
 */
function jenc($data, $flags=JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT) {
    return json_encode($data, $flags);
}

/**
 * Decode JSON data.
 * @param mixed $data  JSON data to decode.
 * @return array  Decoded JSON data.
 */
function jdec($data) {
    return json_decode($data, TRUE);
}
