<?php
return array(
	//'配置项'=>'配置值'
    // 开启布局模版
    'LAYOUT_ON' => true,
    // 默认模版名
    'LAYOUT_NAME' => 'layout',

    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => APP_PATH . 'Tph/Public/css', // 更改默认的/Public 替换规则
        '__JS__'  =>  APP_PATH . 'Tph/Public/js', // 增加新的JS类库路径替换规则
        '__BOOTSTRAP__' => APP_PATH . 'Tph/Public/bootstrap', // 增加新的上传路径替换规则
//        '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则

//        '__IMAGE__' => '/Public/image', // 增加新的上传路径替换规则
    ),
//    'AUTOLOAD_NAMESPACE'
);