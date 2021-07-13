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
use Hyperf\Server\Exception\ServerException;

class Exception extends ServerException
{
    // HTTP 状态码
    const HTTP_STATUS = 200;

    // 自定义处理异常
    public function handle(ResponseInterface $response)
    {
        return $this->render($response)->withStatus(static::HTTP_STATUS);
    }

    // 自定义渲染方法
    public function render(ResponseInterface $response)
    {
        return $response->withHeader('Content-Type', 'text/html;charset=utf-8')->withBody(new SwooleStream($this->getMessage()));
    }
}
