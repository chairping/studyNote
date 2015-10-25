man strace
一个基本上通用的 完整的用法：
strace -o output.txt -T -tt -e trace=all -p 28979
上面的含义是 跟踪28979进程的所有系统调用（-e trace=all），并统计系统调用的花费时间，以及开始时间（并以可视化的时分秒格式显示），
最后将记录结果存在output.txt文件里面。
必须记住的几个用法

1）strace -p pid  可以跟踪某个后台进程
2）strace -o filename 把跟踪结果输出到文件
3）strace -T 记录每个系统调用花费的时间，可以看看哪个系统调用时间长
4）strace -t （或者 -tt）记录每个系统调用发生是的时间（时分秒的格式）
5）strace -s 1024 显示系统调用参数时，对于字符串显示的长度， 默认是32，如果字符串参数很长，很多信息显示不出来。
6）strace -e trace=nanosleep 只记录相关的系统调用信息。
    -e trace=network // 只记录和网络api相关的系统调用
    -e trace=file // 只记录涉及到文件名的系统调用
    -e trace=desc // 只记录涉及到文件句柄的系统调用
还有其他的包括process，ipc，signal等。
一个经典的，通过strace查看一个进程所有相关打开文件的排查过程，参考《linux的strace命令(详解).txt》 新浪电子书可下载
如果开发程序没有一个强大的工具相伴,那么开发效率会非常低,甚至遇到问题无从下手. 现在开始学习linux下的强大的调试工具strace,并记录于此.


strace cat /dev/null
他的输出会有:
open(\\"/dev/null\\",O_RDONLY) = 3
有错误产生时,一般会返回-1.所以会有错误标志和描述:

open(\\"/foor/bar\\",)_RDONLY) = -1 ENOENT (no such file or directory)




五种利用strace查故障的简单方法 
http://blog.csdn.net/dlmu2001/article/details/8842891
通过Strace定位故障原因
http://huoding.com/2013/10/06/288
追踪php代码性能瓶颈
http://ju.outofmemory.cn/entry/47352
Nginx+PHP-FPM优化技巧总结
http://blog.chedushi.com/archives/8211
php中的in_array函数效率分析
http://www.server110.com/php/201309/1150.html
排查PHP-FPM占用CPU过高
http://www.phpgao.com/php-fpm-high-cpu-consumption.html
PHP升级导致系统负载过高问题分析 
http://chuansong.me/n/797172
关于strace
http://www.aslibra.com/blog/read.php/1747.htm




### 寻找被程序读取的配置文件
 strace php 2>&1 | grep php.ini
 
### 跟踪指定的系统调用
strace命令的-e选项仅仅被用来展示特定的系统调用（例如，open，write等等）
cp@cp:~$ strace -e open cat .profile 
open("/etc/ld.so.cache", O_RDONLY|O_CLOEXEC) = 3
open("/lib/x86_64-linux-gnu/libc.so.6", O_RDONLY|O_CLOEXEC) = 3
open("/usr/lib/locale/locale-archive", O_RDONLY|O_CLOEXEC) = 3
open(".profile", O_RDONLY)              = 3

### 跟踪进程
 sudo strace -p 1846
 
### strace的统计概要
strace -c ls

### 保存输出结果
sudo strace -o process_strace -p 3229
之所以以sudo来运行上面的命令，是为了防止用户ID与所查看进程的所有者ID不匹配的情况。

### 显示时间戳
 strace -t ls
 
### 更精细的时间戳
-tt选项可以展示微秒级别的时间戳。
strace -tt ls
 
### 相对时间
-r选项展示系统调用之间的相对时间戳。
 strace -r ls
 
 
 strace常用参数：
 -p 跟踪指定的进程
 -f 跟踪由fork子进程系统调用
 -F 尝试跟踪vfork子进程系统调吸入，与-f同时出现时, vfork不被跟踪
 -o filename 默认strace将结果输出到stdout。通过-o可以将输出写入到filename文件中
 -ff 常与-o选项一起使用，不同进程(子进程)产生的系统调用输出到filename.PID文件
 -r 打印每一个系统调用的相对时间
 -t 在输出中的每一行前加上时间信息。 -tt 时间确定到微秒级。还可以使用-ttt打印相对时间
 -v 输出所有系统调用。默认情况下，一些频繁调用的系统调用不会输出
 -s 指定每一行输出字符串的长度,默认是32。文件名一直全部输出
 -c 统计每种系统调用所执行的时间，调用次数，出错次数。
 -e expr 输出过滤器，通过表达式，可以过滤出掉你不想要输出
 

1. strace追踪多个进程方法：
当有多个子进程的情况下，比如php-fpm、nginx等，用strace追踪显得很不方便。
可以使用下面的方法来追踪所有的子进程。

```
    # vim /root/.bashrc //添加以下内容
    function straceall {
    strace $(pidof "${1}" | sed 's/\([0-9]*\)/-p \1/g')
    }
    # source /root/.bashrc
    
    执行 # traceall php-fpm
```
2  追踪web服务器系统调用情况

```	
# strace -f -F -s 1024 -o nginx-strace /usr/local/nginx/sbin/nginx -c /usr/local/nginx/conf/nginx.conf
# strace -f -F -o php-fpm-strace /usr/local/php/sbin/php-fpm -y /usr/local/php/etc/php-fpm.conf
```
3. 追踪mysql执行语句

```
# strace -f -F -ff -o mysqld-strace -s 1024 -p mysql_pid
# find ./ -name "mysqld-strace*" -type f -print |xargs grep -n "SELECT.*FROM"
```

4. whatisdong---查看程序在干啥

```
#!/bin/bash
# This script is from http://poormansprofiler.org/
nsamples=1
sleeptime=0
pid=$(pidof $1)
 
for x in $(seq 1 $nsamples)
  do
    gdb -ex "set pagination 0" -ex "thread apply all bt" -batch -p $pid
    sleep $sleeptime
  done | \
awk '
  BEGIN { s = ""; } 
  /^Thread/ { print s; s = ""; } 
  /^\#/ { if (s != "" ) { s = s "," $4} else { s = $4 } } 
  END { print s }' | \
sort | uniq -c | sort -r -n -k 1,1
```