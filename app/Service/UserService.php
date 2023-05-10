<?php

namespace App\Service;

use App\Model\User;
use Hyperf\Di\Annotation\Inject;
use Psr\EventDispatcher\EventDispatcherInterface;
use App\Event\UserRegistered;


use Psr\Log\LoggerInterface;
use Hyperf\Logger\LoggerFactory;

class UserService implements UserServiceInterface
{

    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        // 第一个参数对应日志的 name, 第二个参数对应 config/autoload/logger.php 内的 key
        $this->logger = $loggerFactory->get('log', 'default');
    }


    /**
     * @var EventDispatcherInterface
     */
    #[Inject]
    private $eventDispatcher;

    public function getInfoById(int $id)
    {
        return [
          'id' => $id,
          'name'=> 'yiqing',
        ];
    }


    public function register($data=[])
    {
        // 我们假设存在 User 这个实体
        $user = new User();
        $result = $user->save();

        $this->logger->info("user registered！.");
        // 完成账号注册的逻辑
        // 这里 dispatch(object $event) 会逐个运行监听该事件的监听器
        $this->eventDispatcher->dispatch(new UserRegistered($user));
        return $result;
    }
}