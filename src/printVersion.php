<?php
/**
 * User: shflin
 * Time: 2019/1/22 16:37
 */
namespace Lens;

use think\App;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class printVersion extends Command
{

    public function configure()
    {
        $this->setName('version-print')->setDescription('it will print something.');
    }
    
    
    public function execute(Input $input,Output $output)
    {
        $output->write('tp version:'.App::VERSION);
    }
}