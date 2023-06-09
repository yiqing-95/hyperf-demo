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
namespace App\Controller;

use App\Service\UserService;
use App\Service\v2\UserService as UserService2;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

use Hyperf\Paginator\Paginator;
use Hyperf\Utils\Collection;

#[Controller]
class UserController extends AbstractController
{
    #[Inject]
    private UserService2 $userService2;
    private UserService $userService;

    // 在构造函数声明参数的类型，Hyperf 会自动注入对应的对象或值
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Hyperf 会自动为此方法生成一个 /index/index 的路由，允许通过 GET 或 POST 方式请求
    #[RequestMapping(path: "index", methods: "get,post")]
    public function index(RequestInterface $request)
    {
        // 从请求中获得 id 参数
//        $id = $request->input('id', 1);
//        return (string)$id;

        $currentPage = (int) $request->input('page', 1);
        $perPage = (int) $request->input('per_page', 2);

        // 这里根据 $currentPage 和 $perPage 进行数据查询，以下使用 Collection 代替
        $collection = new Collection([
            ['id' => 1, 'name' => 'Tom'],
            ['id' => 2, 'name' => 'Sam'],
            ['id' => 3, 'name' => 'Tim'],
            ['id' => 4, 'name' => 'Joe'],
        ]);

        $users = array_values($collection->forPage($currentPage, $perPage)->toArray());

        return new Paginator($users, $perPage, $currentPage);
    }

    #[RequestMapping(path: "info", methods: "get")]
    public function info(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $id = $request->input('id', 1);
        return $this->userService->getInfoById(intval($id));
    }

    #[RequestMapping(path: "info2", methods: "get")]
    public function info2(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $id = $request->input('id', 1);
        return $this->userService2->getInfoById(intval($id));
    }

    #[RequestMapping(path: "register", methods: "post")]
    public function register(RequestInterface $request)
    {
        // 从请求中获得 id 参数
//        $id = $request->input('id', 1);
//        return $this->userService2->getInfoById(intval($id));

        return $this->userService->register([

        ]) ;
    }

}
