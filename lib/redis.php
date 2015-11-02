class RedisFactory
{
    private $_option;

    public static $_redis = [];

    public function __construct(array $option) {
        $this->setOpeion($option);
    }

    /**
     * @desc
     * @param string $key 应用表示符
     */
    public function create($key = 0) {

        $index = $this->getServerIndex($key);
        $serviceKey = $this->getServiceKey($index);

        if (self::$_redis[$serviceKey]) {
            return self::$_redis[$serviceKey];
        }

        self::$_redis[$serviceKey] = new \Redis();

        $config = $this->getCurrentConfig($index);

        try {
            return $this->connectionReids($serviceKey, $config);
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            if (false !== strpos($msg, "Can't connect") || $msg == 'read error on connection') {
                try {
                    return $this->connectionReids($serviceKey, $config);
                } catch (\Exception $e) {
                    self::$_redis[$serviceKey] = null;

                    $this->_log($e);
                }
            }
            var_dump($msg);
        }
    }

    /**
     * @desc  获取reids服务器索引 仅仅是随机分配服务器给某个应用使用
     * @param $key
     */
    protected function getServerIndex($key) {
        $serverTotal = count($this->_option);

        if (is_numeric($key) && ($key >= 0) && ($key < $serverTotal)) {
            return $key;
        }

        return sprintf("%u", crc32($key)) % $serverTotal;
    }

    /**
     * @desc 获取服务器标识符
     */
    protected function getServiceKey($index) {
        return md5("{$this->_option[$index]['host']}-{$this->_option[$index]['port']}-{$this->_option[$index]['db']}");
    }

    /**
     * @desc  获取当前的配置文件
     * @param $index
     * @return array
     */
    protected function getCurrentConfig($index) {
        return [
            'host' => $this->_option[$index]['host'],
            'password' => $this->_option[$index]['password'],
            'port' => $this->_option[$index]['port'],
            'db' => $this->_option[$index]['db'],
            'weight' => $this->_option[$index]['weight'],
            'timeout' => $this->_option[$index]['timeout']
        ];
    }

    /**
     * @desc  连接redis
     * @param $serviceKey
     * @param $config
     * @return mixed
     */
    protected function connectionReids($serviceKey, $config) {

        self::$_redis[$serviceKey]->connect($config['host'], $config['port'], $config['timeout']);

        if (!empty($config['password'])) {
            self::$_redis[$serviceKey]->auth($config['password']);
        }

        if (isset($config['db'])) {
            self::$_redis[$serviceKey]->select($config['db']);
        }

        return self::$_redis[$serviceKey];
    }

    /**
     * @desc  日志记录
     * @param $e
     */
    private function _log($e){

    }

    public function setOpeion($option) {
        $this->_option = $option;
    }

    public static function getClass($option, $key = 0) {
        $redisFactory = new static($option);
        return $redisFactory->create($key);
    }
}


$options = [
    [
        'host' => '192.168.5.31',
        'password' => '123456',
        'port' => 6379,
        'db' => 1,
        'weight' => 1,
        'timeout' => 1
    ]
];

$redis = RedisFactory::getClass($options);

try {
    $a = $redis->get('friends_zone_view_timeline_89');
    var_dump($a);
    var_dump($redis = RedisFactory::getClass($options));
} catch (Exception $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
}



