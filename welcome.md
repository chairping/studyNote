This is an H1
==============
.git 目录是Git版本库（又叫仓库，repository）
git rev-parse --git-dir  显示版本库目录所在的位置
git rev-parse --show-toplevel   显示工作去根目录
git rev-parse --show-prefix  相对于工作区根目录的相对目录

git config 命令用于读取和更改INI配置文件的内容
git config a.b 
git config a.b something
理解Git暂存区
-------------

设置Git别名
-----------
所有用户
git config --system alias.st status
git config --system alias.ci commit
git config --system alisa.co checkout
git config --system alias.br branch
本用户
git config --global alias.st status
git config --global alias.ci commit
git config --global alisa.co checkout
git config --global alias.br branch

git命令开启颜色显示
git config --global color.ui true