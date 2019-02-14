<?php
/**
 * User: shflin
 * Time: 2019/1/22 17:04
 */
use think\Console;
use Lens\printVersion;
use Lens\command\Module;

Console::init(false)->add(new printVersion,'version-print');
Console::init(false)->add(new Module,'generate:module');
