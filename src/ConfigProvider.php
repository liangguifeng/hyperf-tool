<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Tool;


use Tool\Exception\Handler\ExceptionHandler;
use Tool\Exception\Handler\ResourceExceptionHandler;
use Tool\Facade\Listener;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'exceptions' => [
                'handler' => [
                    'http' => [
                        ExceptionHandler::class,
                        ResourceExceptionHandler::class,
                    ]
                ]
            ],
            'listeners' => [
                Listener::class,
            ],
        ];
    }
}
