<?php
/**
 * User: shflin
 * Time: 2019/1/24 10:37
 */

namespace Lens\services;

use think\facade\Config;
use think\facade\App;

class CreateModel extends Create
{
    
    protected $type = 'Model';
    
    public function create($name,$option=[])
    {
        $info[] = $this->buildClass($name,$option,1);
        $info[] = $this->buildClass($name,$option);
        return $info;
    }
    
    /**
     * 创建类文件，common=1为创建公共模型
     * @param $name
     * @param int $common
     * @param array $option
     * @return mixed
     */
    protected function buildClass($name,$option=[],$common=0)
    {
    
        $stub = file_get_contents($this->getStub($common));
    
        $className = $this->getClassName($name,$common);
    
        $namespace = trim(implode('\\', array_slice(explode('\\', $className), 0, -1)), '\\');
    
        $class = str_replace($namespace . '\\', '', $className);
    
        $pathName = $this->getPathName($className);
    
        $extends = $option['modelExtend'] ?? 'Model';
    
        $content = str_replace(['{%className%}','{%extends%}', '{%actionSuffix%}', '{%namespace%}', '{%app_namespace%}'], [
            $class,
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
    
    
    protected function getStub($common=0)
    {
        $filename = $common == 1 ? 'commonModel.stub' : 'model.stub';
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $filename;
    }
    
}