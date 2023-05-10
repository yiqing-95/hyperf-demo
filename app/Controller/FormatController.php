<?php

namespace App\Controller;


use Hyperf\HttpServer\Annotation\AutoController;
//use Hyperf\HttpServer\Contract\RequestInterface;

use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;
#[AutoController]
class FormatController extends AbstractController
{

    public function json(ResponseInterface $response): Psr7ResponseInterface
    {
        $data = [
            'key' => 'value'
        ];
        return $response->json($data);
    }

    public function xml(ResponseInterface $response): Psr7ResponseInterface
    {
        $data = [
            'key' => 'value',
            'user'=>[
                'name'=>'qing',
            ]
        ];
        return $response->xml($data);
    }

    public function raw(ResponseInterface $response): Psr7ResponseInterface
    {
        return $response->raw('Hello Hyperf.');
    }

    public function redirect(ResponseInterface $response): Psr7ResponseInterface
    {
        // redirect() 方法返回的是一个 Psr\Http\Message\ResponseInterface 对象，需再 return 回去
        return $response->redirect('/format/raw');
    }
}