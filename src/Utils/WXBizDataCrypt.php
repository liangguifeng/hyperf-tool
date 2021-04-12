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
 * 微信小程序加密信息解密工具.
 *
 * Class WXBizDataCrypt
 */
class WXBizDataCrypt
{
    public static $OK = 0;

    public static $IllegalAesKey = -41001;

    public static $IllegalIv = -41002;

    public static $IllegalBuffer = -41003;

    public static $DecodeBase64Error = -41004;

    /**
     * @var
     */
    private $appid;

    /**
     * @var
     */
    private $sessionKey;

    /**
     * WXBizDataCrypt constructor.
     *
     * @param $sessionKey string 用户在小程序登录后获取的会话密钥
     * @param $appid      string 小程序的appid
     */
    public function __construct($appid, $sessionKey)
    {
        $this->sessionKey = $sessionKey;
        $this->appid = $appid;
    }

    /**
     * 检验数据的真实性，并且获取解密后的明文.
     *
     * @param $encryptedData string 加密的用户数据
     * @param $iv            string 与用户数据一同返回的初始向量
     * @param $data          string 解密后的原文
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptData($encryptedData, $iv, &$data)
    {
        if (strlen($this->sessionKey) != 24) {
            return self::$IllegalAesKey;
        }

        $aesKey = base64_decode($this->sessionKey);

        if (strlen($iv) != 24) {
            return self::$IllegalIv;
        }

        $aesIV = base64_decode($iv);

        $aesCipher = base64_decode($encryptedData);

        $result = openssl_decrypt($aesCipher, 'AES-128-CBC', $aesKey, 1, $aesIV);

        $dataObj = json_decode($result);

        if ($dataObj == null) {
            return self::$IllegalBuffer;
        }

        if ($dataObj->watermark->appid != $this->appid) {
            return self::$IllegalBuffer;
        }
        $data = $result;

        return self::$OK;
    }
}
