在命令行执行:php -dvld.active=1 -dvld.execute=0 test.php
-------------------------
```
得到下边的结果:

Finding entry points
Branch analysis from position: 0
Return found
filename:       F:\home\projects\lijingtest\innercode\test.php
function name:  (null)
number of ops:  5
compiled vars:  !0 = $a
line     # *  op                           fetch          ext  return  operands
-------------------------------------------------------------------------------
   2     0  >   ASSIGN                                                   !0, 1
   3     1      ECHO                                                     !0
   4     2      ADD                                              ~1      !0, 1
         3      ECHO                                                     ~1
   6     4    > RETURN                                                   1
```

-dvld.active=1          为设置vld的active参数为1。表示启用vld，php.ini中默认的是0，不开启。

-dvld.execute=0         设置脚本不执行。vld的参数说明，大家百度谷歌之。

Branch analysis from position: 0        ###这个还真不知道干啥的，等以后继续学习……

Return found        ####这段opcode有返回值

filename:           F:\home\projects\lijingtest\innercode\test1.php   ###所在的脚本

function name:  (null)      ####opcode所属函数。全局，此处为null。每个函数会有对应的完整的opcode信息。

number of ops:  5       ##此段opcode有多少个运算操作。

compiled vars:  !0 = $a     ###编译变量。
                            次数缓存在php脚本中声明的变量，有多个的话用,隔开。下边操作中的!0就表示$a的意思。
                            !num,$num,~num都表示变量。!num为脚本声明的变量，$num,~num为临时变量。

op list。运算列表。核心部分。每个op都有7个部分。其中line表示操作所在行号，
                然后是操作num(3没有行号，表示次数操作和2在同行，在一个表达式中)，
                然后是操作符(每个操作符都对应底层c的操作，ASSIGN是赋值操作，ECHO输出操作，ADD加运算……，
                具体说明可以参考php文档或者看源码学习……)，fetch目前本人还不知用途，ext目前未知，return操作的返回值(多为临时变量)，operands操作参数(一个或两个)。



查看opcode，可以帮助理解php脚本执行机制。
能清楚的看到临时变量的产生。比如，上边的$a+1操作就是要产生一个临时变量的。
同样的功能，不同的实现方法，产生的opcode可能不一样，运行效率，占用内存情况也会不同。
比如，好多人说$str.="rrrr" 比 $str=$str."rrrr" 要快,要节省资源。为什么呢？……