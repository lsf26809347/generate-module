<?php
/**
 * User: shflin
 * Time: 2019/1/24 10:52
 */

namespace Lens\services;
use think\facade\Config;
use think\facade\App;
use think\facade\Env;
use think\Db;

abstract class Create
{
    protected $type;
    
    protected function getModuleName($name)
    {
        if (Config::get('app_multi_module')) {
            if (strpos($name, '/')) {
                list($module, $name) = explode('/', $name, 2);
            } else {
                $module = 'common';
            }
        } else {
            $module = null;
        }
        return $module;
    }
    
    protected function getFields($name)
    {
        if (Config::get('app_multi_module')) {
            if (strpos($name, '/')) {
                list($module, $class) = explode('/', $name, 2);
            } else {
                $class = $name;
            }
        } else {
            $class = $name;
        }
        
        $fields = Db::name($class)->getFieldsType();
        
        if(isset($fields['id'])) unset($fields['id']);
        return $fields;
    }
    
    protected function getPathName($name)
    {
        $name = str_replace(App::getNamespace() . '\\', '', $name);
        
        return Env::get('app_path') . ltrim(str_replace('\\', '/', $name), '/') . '.php';
    }
    
    protected function getClassName($name,$common=0)
    {
        $appNamespace = App::getNamespace();
        
        if (strpos($name, $appNamespace . '\\') !== false) {
            return $name;
        }
    
        if (strpos($name, '/')) {
            list($module, $class) = explode('/', $name, 2);
        } else {
            $module = 'common';
            $class = $name;
        }
        if($common){
            $class = 'GenerateModel';
        }
        
        if (strpos($name, '/') !== false) {
            $name = str_replace('/', '\\', $name);
        }
        
        return $this->getNamespace($appNamespace, $module) . '\\' . $this->type . '\\' . $class;
    }
    
    protected function getNamespace($appNamespace, $module)
    {
        return $module ? ($appNamespace . '\\' . $module) : $appNamespace;
    }
}