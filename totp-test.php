<?php
/**
 * Test cases for PHP TOTP
 *
 * PHP version 8
 *
 * @category Authentication
 * @author   Tianchen Tang <galaxyking0419@gmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 * @link     https://github.com/Galaxy0419/php-totp
 */

/**
 * Verify the if the one time password is valid (test version)
 *
 * @param string $input Input string
 * @param string $secret Shared secret between client and server
 * @param int $timestamp Test timestamp
 * @return bool
 */
function totp_verify_test(string $input, string $secret, int $timestamp): bool
{
    $sha1 = hash_hmac('sha1', pack('J', $timestamp / 30), $secret, true);
    $offset = ord($sha1[19]) & 0xf;
    $code = (ord($sha1[$offset]) & 0x7f) << 24 | (ord($sha1[$offset+1]) & 0xff) << 16 |
        (ord($sha1[$offset+2]) & 0xff) << 8 | (ord($sha1[$offset+3]) & 0xff);
    return $code % 1000000 === intval($input);
}

/* The following test data is from https://www.rfc-editor.org/rfc/rfc6238.html#appendix-B */
const SECRET = '12345678901234567890';
const TIMESTAMPS = [59, 1111111109, 1111111111, 1234567890, 2000000000, 20000000000];
const OTPS = ['287082', '081804', '050471', '005924', '279037', '353130'];

for ($i = 0; $i < count(TIMESTAMPS); ++$i)
    assert(totp_verify_test(OTPS[$i], SECRET, TIMESTAMPS[$i]));

echo 'All tests are passed!' . PHP_EOL;
