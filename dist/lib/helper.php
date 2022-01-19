<?php
/**
 * Encode data to JSON.
 * @param mixed $data  Input to encode.
 * @param  mixed $flags  JSON flags to apply.
 * @return string  Data encoded to JSON.
 */
function jenc($data, $flags=JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT) {
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
