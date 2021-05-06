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
namespace Tool\Facade;

use Hyperf\Di\Annotation\AnnotationCollector;

/**
 * 注解处理器.
 *
 * Class Annotation
 */
class Annotation
{
    // 收集控制器类
    public static function controller()
    {
        $annotation = AnnotationCollector::getClassByAnnotation(Annotation\Alias::class);

        foreach ($annotation as $class => $annotation) {
            class_alias($class, $annotation->name);
        }
    }
}
