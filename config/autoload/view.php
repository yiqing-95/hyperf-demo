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

use Hyperf\View\Engine\BladeEngine;
use Hyperf\View\Engine\NoneEngine;
use Hyperf\View\Mode;

return [
//    'engine' => NoneEngine::class,
// composer require duncan3dc/blade
//    'engine' => BladeEngine::class,
    'engine' => \Hyperf\View\Engine\ThinkEngine::class,
    'mode' => Mode::SYNC,
    'config' => [
        'view_path' => BASE_PATH . '/storage/view/',
        'cache_path' => BASE_PATH . '/runtime/view/',
    ],
];
