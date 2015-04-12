<?php

//保存数据库连接信息
$this->container['config']['database.connections'];

//Eloquent(Model)启动  Eloquent类负责启动
Manager::bootEloquent();
    Eloquent::setConnectionResolver($this->manager); //保存manage


Manager::getEventDispatcher(); //Get the current event dispatcher instance.