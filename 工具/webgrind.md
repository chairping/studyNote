用xdebug分析PHP以及结果分析程序webgrind的使用
========================================

XDEBUG配置
----------

xdebug.profiler_enable = 1
xdebug.profiler_enable_trigger = 1 //


webgrind
---------

    webgrind分析结果参数说明：
        分析结果包括了页面执行过程中所访问的方法，函数以及required/include包含的文件。
        Invocation Count        方法被执行的次数
        Total Self Cost         执行该过程/方法的时间，不包括方法内调用执行其他的自定义函数的时间
        Total Inclusive Cost    方法执行的总时间，包括方法内调用的其他方法的执行时间
        Calls                   执行过程中调用的方法/函数
        Total Call Cost         执行所有的调用函数/方法的时间总计
        Count                   方法被调用的次数

        关于不同的颜色的说明：
        蓝色代表PHP内置函数所占耗费时间的比例，
        绿色是自定义函数所占耗费时间的比例，
        灰色是required/include所占耗费时间的比例，
        黄色是过程执行所占时间的比例