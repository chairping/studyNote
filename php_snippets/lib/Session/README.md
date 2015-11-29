# SESSION 管理器
    目前仅支持memached

## 配置项说明

配置文件位于 `cheyou/V4/Config/session.php`

```PHP
    return array(
        'session' => array(
            // 目前仅支持memcached(2015.9.1)
            'driver' => 'memcached',

            // sesion过期时间， 未设置则读取php.ini的session.gc_maxlifetime默认配置
            'sess_expiration' => '',

            // cookie生命周期，优先级：cookie_lifetime > sess_expiration > 0(默认值， 生命周期直到关闭浏览器)
            'cookie_lifetime' => '',

            // cookie名称即session.name 空值则默认为php.ini 的session.name配置
            'cookie_name' => '',

            'cookie_path' => '/',           //
            'cookie_domain' => '',          //
            'cookie_secure' => 0,           // 1为安全链接https

            'save_path' => '',              // 保存路径 保留字段
        )
    );
```
##使用
```PHP
<?php
    use V4\Core\Session\SessionManage;

    /* sesion启动 */
    // 读取默认配置文件
    SessionManage::boot();

    // 自定义配置信息
    SessionManage::boot(array(
        'driver' => 'memcached',
        'cookie_domain' => 'http://api.cherenmei.cn',
    ));


?>
```
