http://php.net/manual/zh/session.configuration.php#ini.session.cookie-lifetime

session.cookie_lifetime  interger
以秒数指定了发送到浏览器的 cookie 的生命周期。值为 0 表示“直到关闭浏览器”。默认为 0.

session.cookie_path string
指定了要设定会话 cookie 的路径。默认为 /

session.cookie_domain string
指定了要设定会话 cookie 的域名。默认为无，表示根据 cookie 规范产生 cookie 的主机名。

session.cookie_secure boolean
指定是否仅通过安全连接发送 cookie。默认为 off。此设定是 PHP 4.0.4 添加的  如果开启则表明你的cookie只有通过HTTPS协议传输时才起作用。

session.gc_maxlifetime integer
指定过了多少秒之后数据就会被视为“垃圾”并被清除。 垃圾搜集可能会在 session 启动的时候开始


max value for "session.gc_maxlifetime" is 65535. values bigger than this may cause  php session stops working.