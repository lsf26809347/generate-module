<?php
/**
 * User: shflin
 * Time: 2019/1/23 14:46
 */

namespace Lens;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Config;
use think\facade\App;
use think\facade\Env;

abstract class Generate extends Command
{
    
    protected function configure()
    {
        $this->addArgument('name', Argument::REQUIRED, "The name of the module");
    }
    
//    abstract protected function execute();

}