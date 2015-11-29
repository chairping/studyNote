<?php

namespace Core\Lib;

class Memcached
{
    protected $memcObj;

    protected $nameSpace = '';

    public function __construct($config = array()) {
        $this->memcObj = new \Memcached();
        $this->memcObj->addServers($config);
        $this->memcObj->setOption(\Memcached::OPT_COMPRESSION, 0);
        $this->memcObj->setOption(\Memcached::OPT_CONNECT_TIMEOUT, 1000);
        $this->memcObj->setOption(\Memcached::OPT_DISTRIBUTION, \Memcached::DISTRIBUTION_CONSISTENT);
    }

    public function setNameSpace($namespace) {
        $this->nameSpace = $namespace;

        return $this;
    }

    /**
     * 向已存在的元素后追加数据
     * @param $key
     * @param $value
     * @param string $nameSpace
     * @return bool
     */
    public function append($key, $value, $nameSpace = '') {
        return $this->memcObj->append($this->getNameSapse($nameSpace) . $key, $value);
    }

    public function delete($key, $time = 0, $nameSpace = '') {
        return $this->memcObj->delete($this->getNameSapse($nameSpace) . $key,  time() + $time);
    }

    public function get($key, $nameSpace = '') {
        !$nameSpace && $nameSpace = $this->nameSpace;
        return $this->memcObj->get($nameSpace . $key);
    }

    public function getMulti($keys = [], $nameSpace = '') {
        $nameSpace = $this->getNameSapse($nameSpace);
        return $this->memcObj->getMulti(array_map(function($key) use ($nameSpace) {
            return $nameSpace . $key;
        }, $keys));
    }

    public function prepend($key, $value, $nameSpace = '') {
        return $this->memcObj->prepend($this->getNameSapse($nameSpace) . $key, $value);
    }

    public function replace($key, $value, $expiration = 0, $nameSpace = '') {
        return $this->memcObj->replace($this->getNameSapse($nameSpace) . $key, $value, time() + $expiration);
    }

    public function set($key, $value, $expiration = 0, $nameSpace = '') {
        return $this->memcObj->set($this->getNameSapse($nameSpace). $key, $value, time() + $expiration);
    }

    public function setMulti($keys, $expiration = 0, $nameSpace = '') {
        !$nameSpace && $nameSpace = $this->nameSpace;
        $items = array();
        foreach ($keys as $key => $value) {
            $items[$nameSpace . $key] = $value;
        }
        return $this->memcObj->setMulti($items, time() + $expiration);
    }

    protected function getNameSapse($nameSpase) {
        return $this->nameSpace . trim($nameSpase);
    }


}