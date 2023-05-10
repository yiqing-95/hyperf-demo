<?php

declare(strict_types=1);

namespace App\Controller;


use App\Exception\FooException;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;

#[AutoController]
class HelloController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function post()
    {
        $post = $this->request->post();

        return [
          'post'=>$post ,
        ];
    }

    // Hyperf 会自动为此方法生成一个 /index/index 的路由，允许通过 GET 或 POST 方式请求
    public function view(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $id = $request->input('id', 1);
        return (string)$id;
    }

    public function env(\Hyperf\Config\Config $config=null)
    {
        // 大部分的网站，有10万人就不错了 hyperf 默认携程数就是 100000 十万😄
        return [
          'in-coroutine'=> \Hyperf\Coroutine\Coroutine::inCoroutine(),
          'Coroutine::id'=>\Hyperf\Coroutine\Coroutine::id(),
            'config-app_name'=> empty($config)? [] : $config->get('app_name') ,
            'config'=>var_dump($config) ,
        ];
    }

    public function exception()
    {
        // 满足某种状态或者条件 咎抛个异常
        throw new FooException('Foo Exception...', 800);
    }

    public function error()
    {
        try {
            $a = [];
            var_dump($a[1]);
        } catch (\Throwable $throwable) {
            var_dump(get_class($throwable), $throwable->getMessage());
        }

// string(14) "ErrorException"
// string(19) "Undefined offset: 1"
    }
}
