<?php
/**
 * Convert data to JSON.
 *
 * @param mixed $data  Input data.
 * @return string|bool  Converted data or false.
 *
 * @example jenc.example.php
 * @see https://php.net/json_encode
 */
function jenc(mixed $data, int $flags=JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT): string|bool {
    return json_encode($data, $flags);
}
