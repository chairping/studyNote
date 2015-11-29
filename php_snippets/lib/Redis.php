<?php
/**
 * Created by PhpStorm.
 * User: cp
 * Date: 15-11-1
 * Time: 上午11:59
 */

namespace Core\Lib;


class Redis
{
    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1');
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function mGet($keys)
    {
        if (!is_array($keys)) {
            $keys = (array) $keys;
        }

        return $this->redis->mget($keys);
    }

    public function set($key, $value, $timeOut = 0)
    {
        return $this->redis->set($key, $value, $timeOut);
    }

    public function mSet(array $sets)
    {
        return $this->redis->mset($sets);
    }

    public function delete($key) {
        return $this->redis->delete($key);
    }

    public function batchDelete($keys)
    {
        if (!is_array($keys)) {
            $keys = (array) $keys;
        }

        return call_user_func_array([$this->redis, 'delete'], $keys);
    }

    public function exists($key)
    {
        return $this->redis->exists($key);
    }

    public function incr($key, $value = 0) {
        if ($value) {
            return $this->redis->incrBy($key, (int)$value);
        }

        return $this->redis->incr($key);
    }

    public function decr($key, $value = 0)
    {
        if($value) {
            return $this->redis->decrBy($key, $value);
        }

        return $this->redis->decr($key);
    }

    public function zAdd($key, $scrore, $value)
    {
        return $this->redis->zAdd($key, $scrore, $value);
    }

    public function zRange()
    {

    }

    public function zCount()
    {

    }

    public function hSet()
    {
//        return $this->redis->h
    }

    public function __call($method, $params = []) {
        if ($params) {
            return call_user_func_array([$this->redis, $method], $params);
        } else {
            return call_user_func([$this->redis, $method]);
        }

    }
}