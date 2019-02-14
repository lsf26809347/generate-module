<?php
/**
 * User: shflin
 * Time: 2019/1/23 17:23
 */

namespace Lens\command;

use Lens\Generate;
use Lens\services\CreateController;
use Lens\services\CreateModel;
use Lens\services\CreateValidate;
use think\console\Input;
use think\console\input\Option;
use think\console\input\Argument;
use think\console\Output;

class Module extends Generate
{
    protected function configure()
    {
        parent::configure();
        $this->setName('generate:module')
            ->addOption('controllerExtend', null, Option::VALUE_REQUIRED, 'The name of extend controller class.')
            ->addOption('modelExtend', null, Option::VALUE_REQUIRED, 'The name of extend model class.')
            ->setDescription('Create a new module include controller,model,view');
    }
    
    
    protected function execute(Input $input, Output $output)
    {
        
        $name = trim($input->getArgument('name'));
        
        $option = $input->getOptions();
        
        $info = (new CreateModel)->create($name,$option);
        
        $info2 = (new CreateController)->create($name,$option);
        
        $info3 = (new CreateValidate)->create($name,$option);
        
        foreach ($info as $value)
        {
            $output->writeln($value);
        }
        
    }
}