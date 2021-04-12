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

use Tool\Exception\ResourceException;

/**
 * 签名类.
 *
 * Class SignUtils
 */
class SignUtils
{
    /**
     * key.
     *
     * @var string
     */
    private static $key = 'liangguifeng_hyperf_tool';

    /**
     * 签名
     * 最后签名最结果为小写.
     *
     * @param $key
     *
     * @return string
     */
    public static function sign(array $arr, $key)
    {
        ksort($arr, SORT_STRING);

        $tmpHttp = http_build_query($arr);

        $tmpHttp = urldecode($tmpHttp);

        if ($tmpHttp) {
            $stringSignTemp = $tmpHttp . '&key=' . $key;
        } else {
            $stringSignTemp = 'key=' . $key;
        }

        $stringSignTemp = base64_encode($stringSignTemp);

        return strtolower(md5($stringSignTemp));
    }

    /**
     * 签名.
     *
     * @param $key
     *
     * @return string
     * @deprecated
     */
    public static function signByLower(array $arr, $key)
    {
        ksort($arr, SORT_STRING);

        $tmpHttp = http_build_query($arr);

        $stringSignTemp = $tmpHttp . '&secret=' . $key;

        $stringSignTemp = urldecode($stringSignTemp);

        return strtolower(md5($stringSignTemp));
    }

    /**
     * 签名校验.
     *
     * @param null $key
     *
     * @return bool
     * @deprecated
     */
    public static function verifySign(array $arr, $key = null)
    {
        if (is_null($key)) {
            $key = self::$key;
        }

        if (! isset($arr['sign'])) {
            throw new $key('缺少sign字段');
        }

        $waiteSign = $arr['sign'];
        unset($arr['sign']);

        ksort($arr, SORT_STRING);

        $tmpHttp = http_build_query($arr);
        $tmpHttp = urldecode($tmpHttp);

        if ($tmpHttp) {
            $stringSignTemp = $tmpHttp . '&key=' . $key;
        } else {
            $stringSignTemp = 'key=' . $key;
        }

        $stringSignTemp = base64_encode($stringSignTemp);

        $sign = strtolower(md5($stringSignTemp));

        if (array_key_exists('timestamp', $arr)) {
            //如果有时间戳校验时间戳
            $timeInterval = time() - $arr['timestamp'];
            if ($timeInterval > 10) {
                return false;
            }
        }

        return $sign == $waiteSign ? true : false;
    }

    /**
     * 签名校验.
     *
     * @param null $secret
     *
     * @return string
     */
    public static function verifySign2(array $arr, $secret)
    {
        if (! isset($arr['signature'])) {
            throw new ResourceException('缺少signature字段');
        }

        $waiteSign = $arr['signature'];
        unset($arr['signature']);
        ksort($arr, SORT_STRING);

        $stringToSign = http_build_query($arr);
        $stringToSign = urldecode($stringToSign);
        $stringToSign = rawurlencode($stringToSign);

        $sign = base64_encode(hash_hmac('sha1', $stringToSign, $secret, true));

        return $sign == $waiteSign ? true : false;
    }

    /**
     * 签名2.0/3.0.
     *
     * @param array $arr 待签名数据
     * @param string $secret 签名秘钥
     *
     * @return string
     */
    public static function signVersion2($arr, $secret)
    {
        ksort($arr, SORT_STRING);

        $stringToSign = http_build_query($arr);
        $stringToSign = urldecode($stringToSign);
        $stringToSign = rawurlencode($stringToSign);

        return base64_encode(hash_hmac('sha1', $stringToSign, $secret, true));
    }

    /**
     * 签名校验.
     *
     * 签名4.0版本
     *
     * @param null $secret
     *
     * @return string
     */
    public static function verifySign4(array $arr, $secret)
    {
        if (! isset($arr['signature'])) {
            throw new ResourceException('缺少signature字段');
        }

        $waiteSign = $arr['signature'];
        unset($arr['signature']);
        ksort($arr, SORT_STRING);

        $stringToSign = http_build_query($arr);
        $stringToSign = urldecode($stringToSign);
        $stringToSign = rawurlencode($stringToSign);

        $sign = rawurlencode(base64_encode(hash_hmac('sha1', $stringToSign, $secret, true)));

        return $sign == $waiteSign ? true : false;
    }

    /**
     * 签名4.0.
     *
     * @param array $arr 待签名数据
     * @param string $secret 签名秘钥
     *
     * @return string
     */
    public static function signVersion4($arr, $secret)
    {
        ksort($arr, SORT_STRING);

        $stringToSign = http_build_query($arr);
        $stringToSign = urldecode($stringToSign);
        $stringToSign = rawurlencode($stringToSign);

        return rawurlencode(base64_encode(hash_hmac('sha1', $stringToSign, $secret, true)));
    }
}
