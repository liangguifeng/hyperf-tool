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
 * Class XmlUtils.
 */
class XmlUtils
{
    /**
     * 数组转xml字符.
     *
     * @param $array
     *
     * @return bool|string
     */
    public static function arrayToXml($array)
    {
        if (! is_array($array) || count($array) <= 0) {
            return false;
        }

        $xml = '<xml>';
        foreach ($array as $key => $val) {
            if (is_numeric($val)) {
                $xml .= '<' . $key . '>' . $val . '</' . $key . '>';
            } else {
                $xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
            }
        }

        $xml .= '</xml>';

        return $xml;
    }

    /**
     * xml转array.
     *
     * @param $xml
     *
     * @return array
     */
    public static function xmlToArray($xml)
    {
        $object = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        return get_object_vars($object);
    }
}
