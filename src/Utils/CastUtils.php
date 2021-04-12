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
 * 布尔工具类.
 *
 * Class CastUtils
 */
class CastUtils
{
    /**
     * 转化布尔值为是否.
     * @param mixed $value
     */
    public static function castBool2YesOrNo($value)
    {
        return $value == true ? '是' : '否';
    }

    /**
     * 转换是否为布尔值
     *
     * @param $value
     *
     * @return bool
     */
    public static function castYesOrNo2Bool($value)
    {
        return $value == '是' ? true : false;
    }

    /**
     * 转换是否为布尔值
     *
     * @param $value
     *
     * @return bool
     */
    public static function castOnOrOff2Bool($value)
    {
        return $value == 'on' ? true : false;
    }
}
