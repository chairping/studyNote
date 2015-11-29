<?php
namespace Core\Lib\Session;

class SessionManage {

    private $_driver = '';
    private $_driverClass;
    // 配置信息
    private $_config = array();

    public static function boot(array $params = array()) {
        return new self($params);
    }

    private function __construct($params)
    {

        if (isset($params['driver']) && !empty($params['driver']))
        {
            $this->_driver = $params['driver'];
            unset($params['driver']);
        }

        $class = $this->loadClass($this->_driver);

        $this->configure($params);

        $this->_driverClass = new $class($this->_config);

        if ($this->_driverClass instanceof \SessionHandlerInterface)
        {
            if(!session_set_save_handler($this->_driverClass))
            {
                throw new \Exception("Couldn't set session handler.");
            }
        }
        else
        {
            throw new \Exception("Session driver: Configured driver '".$this->_driver."' must implements SessionHandlerInterface.");
        }

        session_start();
    }

    /**
     * @desc 获取session驱动类名
     * @param $driver
     * @return string
     * @throws \Exception
     */
    protected function loadClass($driver)
    {
        $class = __NAMESPACE__ . '\Drivers\\' . ucfirst($driver) . 'Driver';
        if (class_exists($class))
        {
            return $class;
        }

        throw new \Exception("Session: Configured driver '".$driver."' was not found. Aborting.");
    }

    /**
     * @desc   session cookie 配置信息
     * @param $params
     */
    protected function configure($params) {

        $expiration = (int) $params['sess_expiration'];

        if (empty($params['cookie_lifetime'])) {
            $params['cookie_lifetime'] = !empty($expiration) ? $expiration : 0;
        }

        if (empty($params['cookie_name'])) {
            $params['cookie_name'] = ini_get('session.name');
        } else {
            ini_set('session.name', $params['cookie_name']);
        }

        session_set_cookie_params(
            $params['cookie_lifetime'],
            $params['cookie_path'],
            $params['cookie_domain'],
            $params['cookie_secure'],
            TRUE // HttpOnly; Yes, this is intentional and not configurable for security reasons
        );

        if (empty($expiration)) {
            $params['expiration'] = (int) ini_get('session.gc_maxlifetime');
        } else {
            $params['expiration'] = (int) $expiration;
            ini_set('session.gc_maxlifetime', $expiration);
        }

        $this->_config = $params;

        // Security is king
        ini_set('session.use_trans_sid', 0);
        ini_set('session.use_strict_mode', 1);
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.hash_function', 1);
        ini_set('session.hash_bits_per_character', 4);
    }

    /**
     * @desc  获取配置信息
     * @return array
     */
    public function getConfigure() {
        return $this->_config;
    }

} 