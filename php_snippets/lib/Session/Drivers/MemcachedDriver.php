<?php
namespace Core\Lib\Session\Drivers;

use Core\Lib\Session\Driver;

class MemcachedDriver extends Driver implements \SessionHandlerInterface{

    public function open($save_path = '', $name = '') {
        return true;
    }

    public function read($session_id)
    {
        return container('memcached')->get($session_id, $this->_prefix);
    }

    public function write($session_id, $session_data)
    {
        return container('memcached')->set($session_id, $session_data, $this->_expire, $this->_prefix);
    }

    public function destroy($session_id)
    {
        return container('memcached')->delete($session_id, 0, $this->_prefix);
    }

    public function close()
    {
        return true;
    }

    public function gc($maxlifetime = '')
    {
        return true;
    }
} 