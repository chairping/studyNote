<?php if (!defined('THINK_PATH')) exit();?><!-- Main bar -->
<style>
    .mainbar{
        font-size:14px;
        padding:10px;
    }

    p{
        line-height:30px;
    }
</style>
<div class="mainbar">

    <h1>帮助</h1>
    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/1.png" alt="" /></a>

    <p>测试中我使用的是Sqlite数据库，复制数据库文件到项目目录下，如使用Mysql数据库可以省略此步骤。</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/2.png" alt="" /></a>

    <p>将TPH文件夹复制到项目目录下。</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/3.png" alt="" /></a>

    <p>修改项目配置文件，主要是配置数据库信息。</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/4.png" alt="" /></a>

    <p>访问一下TPH，应该看到以上界面</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/5.png" alt="" /></a>

    <p>点击“生成模块选项”选择好目标模块，把需要生成的表名打上勾，点击生成。成功后，会有提示生成路径。此步骤主要是为了生成布局文件。</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/6.png" alt="" /></a>

    <p>点击“生成CRUD代码”，注意选择和上一步相同的数据表，点击生成文件。</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/7.png" alt="" /></a>

    <p>修改Index控制器下的index方法内容为：$this-&gt;show();如图</p><br>

    <a href="http://weiyunstudio.qiniudn.com/1.png"><img class="alignnone" src="http://weiyunstudio.qiniudn.com/8.png" alt="" /></a>

    <p>再次访问你的项目，have fun.</p><br>

    &nbsp;

    &nbsp;

    <p>注：聪明的你一定发现了，布局模板是可以自定义的，你可以创建自己的模板风格进行生成，具体做法是在TPH/Template文件夹下创建一个文件夹，在此文件夹下创建一个名为“layout.html”的布局文件，新的布局名称就是文件夹名。</p><br>

</div>