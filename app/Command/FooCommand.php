<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[Command]
class FooCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('demo:foo');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
        $this->setHelp('Hyperf 自定义命令演示');
        $this->addUsage('--name 演示代码');

        $this->addOption('opt', 'o', InputOption::VALUE_NONE, '是否优化');

        // 可以看到同样是参数定义 出现在这里的会后解析？
//        $this->addArgument('name', InputArgument::OPTIONAL, '姓名', 'Hyperf');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, '这里是对这个参数的解释'],
            ['name2', InputArgument::IS_ARRAY, '可以给我一堆名字'],
        ];
    }

    public function handle()
    {
        // 从 $input 获取 name 参数
        $argument = $this->input->getArgument('name') ?? 'World';
        $argNames = $this->input->getArgument('name2') ?? ['World'];
        $this->line('Hello ' . $argument, 'info');
        $this->line('names: ' . implode(',',$argNames), 'info');

        var_dump($this->input->getOption('opt'));
    }
}
