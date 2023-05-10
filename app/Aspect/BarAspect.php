<?php

namespace App\Aspect;

use App\Service\UserService;
use App\Annotation\Foo;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

#[
    Aspect(
        classes: [
//            SomeClass::class,
            "App\Service\UserService::getUserInfo",
//            "App\Service\SomeClass::*Method"
        ],
        annotations: [
            Foo::class
        ]
    )
]
class BarAspect extends AbstractAspect
{
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
//        $proceedingJoinPoint->
        // 切面切入后，执行对应的方法会由此来负责
        // $proceedingJoinPoint 为连接点，通过该类的 process() 方法调用原方法并获得结果
        // 在调用前进行某些处理
        $result = $proceedingJoinPoint->process();
        // 在调用后进行某些处理
        return $result;
    }
}