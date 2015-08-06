<?php
//首先来看下 UserController.php 文件的index方法
class UserController {
    public function index()
    {
        return User::all();
    }
}
// 该方法简单的返回用户列表.
// 然而, 这个方式会带来一些问题
// 1 不够灵活, User::all() 直接使用Laravel 的 ORM.如果你想切换到其他数据库,
// 比如 redis 或者 Mongo, 则碧玺找到应用中使用Eloquent的代码, 然后更新它.
// 在大的应用中是非常麻烦的.
// 这个看起来不是什么大问题, 但是相信我! 你可以想象下, 随着业务的增长和项目的扩大, 这样真的好吗?
// 我们建立坚固的应用基石并不是很困难, Laravel可以更简单的解决这类问题.

// 为了解耦我们的控制器和数据库, 我们使用仓库来抽象之间的相互影响.
// A repository is simply an interface between two things.
// 我们可以使用UserReqpository 来替换 Eloquent
// 我们可以绑定 UserRepository to EloquentUserRepository.
// Now that we have abstracted the database layer into repositories it makes it much easier to switch database ORM.
//For example, if you wanted to use Mongo instead, you would simply create a MongoUserRepository and bind UserRepository to it rather than EloquentUserRepository.

interface UserRepository {
    public function all();

    public function find($id);

    public function create($input);
}
class EloquentUserRepository implements UserRepository {

    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create($input)
    {
        return User::create($input);
    }

}

//public function __construct(User $user)
//{
//    $this->user = $user;
//}
//
//public function index()
//{
//    return $this->user->all();
//}


