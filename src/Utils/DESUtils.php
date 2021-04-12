<?php

declare(strict_types=1);
/**
 * This file is part of liangguifeng.
 *
 * @link     https://findcat.cn
 * @document https://findcat.cn
 * @contact  1476982312@qq.com
 */
namespace Tool\Utils;

/**
 * DES加解密工具.
 *
 * Class DESUtils
 */
class DESUtils
{
    /**
     * 加密.
     *
     * @param $str
     * @param mixed $key
     *
     * @return string
     */
    public static function encrypt($str, $key)
    {
        if (strlen($str) % 8) {
            $str = str_pad(
                $str,
                strlen($str) + 8 - strlen($str) % 8,
                "\0"
            );
        }

        $sign = openssl_encrypt($str, 'DES-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);

        return base64_encode($sign);
    }

    /**
     * 解密.
     *
     * @param $encrypted
     * @param mixed $key
     *
     * @return string
     */
    public function decrypt($encrypted, $key)
    {
        $encrypted = base64_decode($encrypted);

        $sign = openssl_decrypt($encrypted, 'DES-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);

        $sign = $this->unPkcsPadding($sign);

        return rtrim($sign);
    }

    /**
     * @param $data
     *
     * @return string
     */
    public static function unpadZero($data)
    {
        return rtrim($data, "\0");
    }

    /**
     * 填充.
     *
     * @param $str
     * @param $blocksize
     *
     * @return string
     */
    public static function pkcsPadding($str, $blocksize)
    {
        $pad = $blocksize - (strlen($str) % $blocksize);

        return $str . str_repeat(chr($pad), $pad);
    }

    /**
     * 去填充.
     *
     * @param $str
     *
     * @return string
     */
    private function unPkcsPadding($str)
    {
        $pad = ord($str[strlen($str) - 1]);
        if ($pad > strlen($str)) {
            return false;
        }

        return substr($str, 0, -1 * $pad);
    }
}
