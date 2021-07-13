<?php

declare(strict_types=1);
/**
 * This file is part of liangguifeng.
 *
 * @link     https://findcat.cn
 * @document https://findcat.cn
 * @contact  1476982312@qq.com
 */
namespace Tool\Exception;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;

class JsonException extends Exception
{
    // 状态码
    const CODE = 0;

    // 携带状态码
    public function __construct($message, $code = null)
    {
        parent::__construct($message, $code ?? static::CODE);
    }

    // JSON Code 渲染
    public function render(ResponseInterface $response)
    {
        $data = json_encode($this->json(), JSON_UNESCAPED_UNICODE);

        return $response->withHeader('Content-Type', 'text/html;charset=utf-8')->withBody(new SwooleStream($data));
    }

    // json 格式
    protected function json()
    {
        return [
            'code' => $this->getCode(),
            'message' => $this->getMessage()
        ];
    }
}
