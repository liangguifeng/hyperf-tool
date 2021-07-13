<?php

declare(strict_types=1);
/**
 * This file is part of liangguifeng.
 *
 * @link     https://findcat.cn
 * @document https://findcat.cn
 * @contact  1476982312@qq.com
 */
namespace Tool\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler as ToolExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Tool\Exception\Exception;

class ExceptionHandler extends ToolExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // 判断被捕获到的异常是希望被捕获的异常
        if($throwable instanceof Exception) {
            // 阻止异常冒泡
            $this->stopPropagation();

            // 自定义处理
            return $throwable->handle($response);
        }

        // 交给下一个异常处理器
        return $response;
    }

    /**
     * 判断该异常处理器是否要对该异常进行处理.
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
