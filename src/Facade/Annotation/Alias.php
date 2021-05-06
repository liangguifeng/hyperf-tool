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
namespace Tool\Facade\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 *
 * @Target({"CLASS"})
 */
class Alias extends AbstractAnnotation
{
    public $name;

    public function __construct($value = null)
    {
        $this->bindMainProperty('name', $value);
    }
}
