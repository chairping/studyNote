
$ git config --global user.name "Your Name"
$ git config --global user.email "email@example.com"


$ git log
    commit 3628164fb26d48395383f8f31179f24e0882e1e0
    Author: Michael Liao <askxuefeng@gmail.com>
    Date:   Tue Aug 20 15:11:49 2013 +0800

    append GPL

    commit ea34578d5496d7dd233c827ed32a8cd576c5ee85
    Author: Michael Liao <askxuefeng@gmail.com>
    Date:   Tue Aug 20 14:53:12 2013 +0800 

    add distributed

    commit cb926e7ea50ad11b8f9e909c05226233bf755030
    Author: Michael Liao <askxuefeng@gmail.com>
    Date:   Mon Aug 19 17:51:55 2013 +0800 

    wrote a readme file

$ git log --pretty=oneline
    3628164fb26d48395383f8f31179f24e0882e1e0 append GPL
    ea34578d5496d7dd233c827ed32a8cd576c5ee85 add distributed
    cb926e7ea50ad11b8f9e909c05226233bf755030 wrote a readme file

用HEAD表示当前版本
一个版本就是HEAD^
上上一个版本就是HEAD^^
$ git reset --hard HEAD^
    HEAD is now at ea34578 add distributed

go back something version
$ git reset --hard 3628164
HEAD is now at 3628164 append GPL


Git提供了一个命令git reflog用来记录你的每一次命令:
$ git reflog
ea34578 HEAD@{0}: reset: moving to HEAD^
3628164 HEAD@{1}: commit: append GPL
ea34578 HEAD@{2}: commit: add distributed
cb926e7 HEAD@{3}: commit (initial): wrote a readme file

用git diff HEAD -- readme.txt命令可以查看工作区和版本库里面最新版本的区别：
$ git diff HEAD -- readme.txt
    diff --git a/readme.txt b/readme.txt
    index 76d770f..a9c5755 100644
    --- a/readme.txt
    +++ b/readme.txt
    @@ -1,4 +1,4 @@
    Git is a distributed version control system.
    Git is free software distributed under the GPL.
    Git has a mutable index called stage.
    -Git tracks changes.
    +Git tracks changes of files.


Git会告诉你，git checkout -- file可以丢弃工作区的修改：
$ git checkout -- readme.txt

命令git reset HEAD file可以把暂存区的修改撤销掉（unstage），重新放回工作区：
$ git reset HEAD readme.txt
Unstaged changes after reset:
M       readme.txt



场景1：当你改乱了工作区某个文件的内容，想直接丢弃工作区的修改时，
            用命令git checkout -- file。

场景2：当你不但改乱了工作区某个文件的内容，还添加到了暂存区时，想丢弃修改，
        分两步，第一步用命令git reset HEAD file，就回到了场景1，第二步按场景1操作。

场景3：已经提交了不合适的修改到版本库时，想要撤销本次提交，参考版本回退一节，
        不过前提是没有推送到远程库



SSH Key:
$ ssh-keygen -t rsa -C "youremail@example.com"

在右上角找到“Create a new repo”按钮，创建一个新的仓库：
在Repository name填入learngit，其他保持默认设置，点击“Create repository”按钮，
就成功地创建了一个新的Git仓库：
$ git remote add origin git@github.com:michaelliao/learngit.git

把本地库的内容推送到远程，用git push命令，实际上是把当前分支master推送到远程。

由于远程库是空的，我们第一次推送master分支时，加上了-u参数，
Git不但会把本地的master分支内容推送的远程新的master分支，
还会把本地的master分支和远程的master分支关联起来，
在以后的推送或者拉取时就可以简化命令。

首先，我们创建dev分支，然后切换到dev分支：

$ git checkout -b dev
Switched to a new branch 'dev'

git checkout命令加上-b参数表示创建并切换，相当于以下两条命令：
$ git branch dev
$ git checkout dev
Switched to branch 'dev'



推送分支，就是把该分支上的所有本地提交推送到远程库。推送时，要指定本地分支，这样，Git就会把该分支推送到远程库对应的远程分支上：
$ git push origin master
如果要推送其他分支，比如dev，就改成：
$ git push origin dev

现在，你的小伙伴要在dev分支上开发，就必须创建远程origin的dev分支到本地，于是他用这个命令创建本地dev分支：
$ git checkout -b dev origin/dev

it branch --set-upstream-to=origin/<branch> dev

cp@cp:/var/www/html/Git/studyNote$ git branch --set-upstream-to=origin/dev dev
分支 dev 设置为跟踪来自 origin 的远程分支 dev。

查看远程库信息，使用git remote -v；
本地新建的分支如果不推送到远程，对其他人就是不可见的；
从本地推送分支，使用git push origin branch-name，如果推送失败，先用git pull抓取远程的新提交；
在本地创建和远程分支对应的分支，使用git checkout -b branch-name origin/branch-name，本地和远程分支的名称最好一致；
建立本地分支和远程分支的关联，使用git branch --set-upstream branch-name origin/branch-name；
从远程抓取分支，使用git pull，如果有冲突，要先处理冲突。




