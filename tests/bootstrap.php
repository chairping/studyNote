<?php
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
// 定义应用目录
define('APP_PATH', __DIR__ . '/../Application/');
try{
    require __DIR__ . '/../ThinkPHP/ThinkPHP.php';
}catch (\Think\Exception $e) {
}
