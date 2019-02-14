<?php
/**
 * User: shflin
 * Time: 2019/1/24 10:37
 */

namespace Lens\services;

use think\facade\Config;
use think\facade\App;

class CreateView extends Create
{
    
    protected $type = 'View';
    
    public function create($name,$option=[])
    {
        $info[] = $this->buildClass($name,$option);
        return $info;
    }
    
    /**
     * 创建类文件
     * @param $name
     * @param array $option
     * @return mixed
     */
    protected function buildClass($name,$option=[])
    {
        
        $stub = file_get_contents($this->getStub());
        
        $className = $this->getClassName($name);
        
        $namespace = trim(implode('\\', array_slice(explode('\\', $className), 0, -1)), '\\');
        
        $class = str_replace($namespace . '\\', '', $className);
        
        $pathName = $this->getPathName($className);
        
        $modelClass = (new CreateModel())->getClassName($name);
        
        $extends = $option['validateExtend'] ?? 'Validate';
        
        $moduleName = $this->getModuleName($name);
        
        $content = str_replace(['{%className%}','{%modelClass%}','{%moduleName%}','{%extends%}', '{%actionSuffix%}', '{%namespace%}', '{%app_namespace%}'], [
            $class,
            $modelClass,
            $moduleName,
            $extends,
            Config::get('action_suffix'),
            $namespace,
            App::getNamespace(),
        ], $stub);
        
        if (is_file($pathName)) {
            if($common==0){
                return '<error>' . $className . ' already exists!</error>';
            }else{
                return '<info>' . $className . ' already exists! pass!</info>';
            }
        }
        
        if (!is_dir(dirname($pathName))) {
            mkdir(dirname($pathName), 0755, true);
        }
        
        file_put_contents($pathName, $content);
        
        return '<info>' . $className . ' created successfully.</info>';
    }
    
    
    protected function getStub()
    {
        $filename = 'validate.stub';
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $filename;
    }
    
}