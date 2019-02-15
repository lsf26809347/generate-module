# thinkphp-gii
## 自动生成简单的增删改查代码
## 安装
```
composer require lsf26809347/thinkphp-gii
```
## 命令
#### 基础命令
```
php think generate:module {module/}Index
```
module可以省略，省略时默认为common模块，如要指定模块可以用以下命令
```
php think generate:module Index/Index
```
该命令将在 
- application/Index/Controller目录下生成Index.php;
- application/Index/Model目录下生成GenerateModel.php、Index.php，Index模型类自动继承自GenerateModel;
- application/Index/Validate目录下生成Index.php。
#### 参数
可以在基础命令后添加参数，来指定控制器与模型的继承类
```
php think generate:module Index/Index --controllerExtend Common --modelExtend  Base
```
上面命令生成的Index控制器将继承自Common，generateModel模型基类将继承自Base.
