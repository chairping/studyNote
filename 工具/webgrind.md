��xdebug����PHP�Լ������������webgrind��ʹ��
========================================

XDEBUG����
----------

xdebug.profiler_enable = 1
xdebug.profiler_enable_trigger = 1 //

## �����ļ��ŵ� /tmp Ŀ¼��
xdebug.profiler_output_dir = "/tmp/xdebug.profile/"

webgrind
---------
    ���أ� git clone git://github.com/jokkedk/webgrind.git

    ���ã�Show Call Graph ��ť������ python �� dot ����
        �鿴 python �� dot ����λ�� which python which dot���༭ webgrind/config.php��
        �� $pythonExecutable = '/usr/bin/python' �� $dotExecutable = '/usr/bin/dot' �滻Ϊ�ղ鵽��Ӧ·����

    webgrind�����������˵����
        �������������ҳ��ִ�й����������ʵķ����������Լ�required/include�������ļ���
        Invocation Count        ������ִ�еĴ���
        Total Self Cost         ִ�иù���/������ʱ�䣬�����������ڵ���ִ���������Զ��庯����ʱ��
        Total Inclusive Cost    ����ִ�е���ʱ�䣬���������ڵ��õ�����������ִ��ʱ��
        Calls                   ִ�й����е��õķ���/����
        Total Call Cost         ִ�����еĵ��ú���/������ʱ���ܼ�
        Count                   ���������õĴ���

        ���ڲ�ͬ����ɫ��˵����
        ��ɫ����PHP���ú�����ռ�ķ�ʱ��ı�����
        ��ɫ���Զ��庯����ռ�ķ�ʱ��ı�����
        ��ɫ��required/include��ռ�ķ�ʱ��ı�����
        ��ɫ�ǹ���ִ����ռʱ��ı���


        

graphviz
-----------

    # yum install graphviz