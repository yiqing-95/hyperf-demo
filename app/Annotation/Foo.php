<?php

namespace App\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Bar extends AbstractAnnotation
{
    // some code
}

#[Attribute(Attribute::TARGET_CLASS)]
class Foo extends AbstractAnnotation
{
    // some code
}