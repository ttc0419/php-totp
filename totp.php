<?php
/**
 * A simple, fast TOTP(Time-Based One-Time Password) implementation in PHP
 *
 * PHP version 8
 *
 * @category Authentication
 * @author   Tianchen Tang <galaxyking0419@gmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 * @link     https://github.com/Galaxy0419/php-totp
 */

/**
 * Verify the if the one time password is valid
 *
 * @param string $input Input string
 * @param string $secret Shared secret between client and server
 * @return bool
 */
function totp_verify(string $input, string $secret): bool
{
    $sha1 = hash_hmac('sha1', pack('J', time() / 30), $secret, true);
    $offset = ord($sha1[19]) & 0xf;
    $code = (ord($sha1[$offset]) & 0x7f) << 24 | (ord($sha1[$offset+1]) & 0xff) << 16 |
        (ord($sha1[$offset+2]) & 0xff) << 8 | (ord($sha1[$offset+3]) & 0xff);
    return $code % 1000000 === intval($input);
}
