<?php
namespace Tool\Log;

use Hyperf\Logger\LoggerFactory;

class Log
{
    public static function get(string $name, $group = 'default')
    {
        return container(LoggerFactory::class)->get($name, $group);
    }
}
