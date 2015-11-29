<?php
namespace Core\Lib\Session;

abstract class Driver {

    protected $_prefix = '';
    protected $_expire;

    public function __construct($params)
    {
        if (isset($params['prifix']) && !empty($params['prifix'])) {
            $this->_prifix = $params['prifix'];
        }

        $this->_expire = $params['expiration'];
    }
} 