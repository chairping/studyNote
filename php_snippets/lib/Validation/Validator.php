<?php
namespace Core\Lib\Validation;

class Validator
{
    const ERROR_DEFAULT = 'Invalid';

    protected $_fields = array();

    protected $_errors = array();

    protected $_validations = array();

    protected $_labels = array();

    protected static $_lang;

    protected static $_rules = array();

    protected static $_ruleMessages = array();

    protected $validUrlPrefixes = array('http://', 'https://', 'ftp://');

    public function __construct($data, $fields = array()) {

        $this->_fields = !empty($fields) ? array_intersect_key($data, array_flip($fields)) : $data;

        self::_initRuleMessages();
    }

    private static function _initRuleMessages() {
        static::$_ruleMessages = [
            'required'      => "不能为空",
            'equals'        => "必须和'%s'一致",
            'different'     => "必须和'%s'不一致",
            'accepted'      => "必须接受",
            'numeric'       => "只能是数字",
            'integer'       => "只能是整数(0-9)",
            'length'        => "长度必须大于%d",
            'min'           => "必须大于%s",
            'max'           => "必须小于%s",
            'in'            => "无效的值",
            'notIn'         => "无效的值",
            'ip'            => "无效IP地址",
            'email'         => "无效邮箱地址",
            'url'           => "无效的URL",
            'urlActive'     => "必须是可用的域名",
            'alpha'         => "只能包括英文字母(a-z)",
            'alphaNum'      => "只能包括英文字母(a-z)和数字(0-9)",
            'slug'          => "只能包括英文字母(a-z)、数字(0-9)、破折号和下划线",
            'regex'         => "无效格式",
            'date'          => "无效的日期",
            'dateFormat'    => "日期的格式应该为'%s'",
            'dateBefore'    => "日期必须在'%s'之前",
            'dateAfter'     => "日期必须在'%s'之后",
            'contains'  => "必须包含%s"
        ];
    }

    /**
     * Required field validator
     *
     * @param  string $field
     * @param  mixed  $value
     * @return bool
     */
    protected function validateRequired($field, $value)
    {
        if ($value === null) {
            return false;
        } elseif (is_string($value) && trim($value) === '') {
            return false;
        }

        return true;
    }

    protected function validateEquals($field, $value, array $params)
    {
        $field2 = $params[0];

        return isset($this->_fields[$field2]) && $value == $this->_fields[$field2];
    }

    protected function validateDifferent($field, $value, array $params)
    {
        $field2 = $params[0];

        return isset($this->_fields[$field2]) && $value != $this->_fields[$field2];
    }

    protected function validateAccepted($field, $value)
    {
        $acceptable = array('yes', 'on', 1, true);

        return $this->validateRequired($field, $value) && in_array($value, $acceptable, true);
    }

    protected function validateArray($field, $value)
    {
        return is_array($value);
    }

    protected function validateNumeric($field, $value)
    {
        return is_numeric($value);
    }

    protected function validateInteger($field, $value)
    {
        return filter_var($value, \FILTER_VALIDATE_INT) !== false;
    }

    protected function validateLength($field, $value, $params)
    {
        $length = $this->stringLength($value);
        // Length between
        if (isset($params[1])) {
            return $length >= $params[0] && $length <= $params[1];
        }
        // Length same
        return $length == $params[0];
    }

    protected function validateLengthBetween($field, $value, $params)
    {
        $length = $this->stringLength($value);

        return $length >= $params[0] && $length <= $params[1];
    }

    protected function validateLengthMin($field, $value, $params)
    {
        return $this->stringLength($value) >= $params[0];
    }

    protected function validateLengthMax($field, $value, $params)
    {
        return $this->stringLength($value) <= $params[0];
    }

    protected function stringLength($value)
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($value);
        }

        return strlen($value);
    }

    protected function validateMin($field, $value, $params)
    {
        if (function_exists('bccomp')) {
            return !(bccomp($params[0], $value, 14) == 1);
        } else {
            return $params[0] <= $value;
        }
    }

    protected function validateMax($field, $value, $params)
    {
        if (function_exists('bccomp')) {
            return !(bccomp($value, $params[0], 14) == 1);
        } else {
            return $params[0] >= $value;
        }
    }


    protected function validateIn($field, $value, $params)
    {
        $isAssoc = array_values($params[0]) !== $params[0];
        if ($isAssoc) {
            $params[0] = array_keys($params[0]);
        }

        $strict = false;
        if (isset($params[1])) {
            $strict = $params[1];
        }

        return in_array($value, $params[0], $strict);
    }

    protected function validateNotIn($field, $value, $params)
    {
        return !$this->validateIn($field, $value, $params);
    }

    protected function validateContains($field, $value, $params)
    {
        if (!isset($params[0])) {
            return false;
        }
        if (!is_string($params[0]) || !is_string($value)) {
            return false;
        }

        return (strpos($value, $params[0]) !== false);
    }

    protected function validateIp($field, $value)
    {
        return filter_var($value, \FILTER_VALIDATE_IP) !== false;
    }

    protected function validateEmail($field, $value)
    {
        return filter_var($value, \FILTER_VALIDATE_EMAIL) !== false;
    }

    protected function validateUrl($field, $value)
    {
        foreach ($this->validUrlPrefixes as $prefix) {
            if (strpos($value, $prefix) !== false) {
                return filter_var($value, \FILTER_VALIDATE_URL) !== false;
            }
        }

        return false;
    }

    protected function validateUrlActive($field, $value)
    {
        foreach ($this->validUrlPrefixes as $prefix) {
            if (strpos($value, $prefix) !== false) {
                $url = str_replace($prefix, '', strtolower($value));

                return checkdnsrr($url);
            }
        }

        return false;
    }

    protected function validateAlpha($field, $value)
    {
        return preg_match('/^([a-z])+$/i', $value);
    }

    protected function validateAlphaNum($field, $value)
    {
        return preg_match('/^([a-z0-9])+$/i', $value);
    }

    protected function validateSlug($field, $value)
    {
        return preg_match('/^([-a-z0-9_-])+$/i', $value);
    }

    protected function validateRegex($field, $value, $params)
    {
        return preg_match($params[0], $value);
    }

    protected function validateDate($field, $value)
    {
        $isDate = false;
        if ($value instanceof \DateTime) {
            $isDate = true;
        } else {
            $isDate = strtotime($value) !== false;
        }

        return $isDate;
    }

    protected function validateDateFormat($field, $value, $params)
    {
        $parsed = date_parse_from_format($params[0], $value);

        return $parsed['error_count'] === 0 && $parsed['warning_count'] === 0;
    }

    protected function validateDateBefore($field, $value, $params)
    {
        $vtime = ($value instanceof \DateTime) ? $value->getTimestamp() : strtotime($value);
        $ptime = ($params[0] instanceof \DateTime) ? $params[0]->getTimestamp() : strtotime($params[0]);

        return $vtime < $ptime;
    }

    protected function validateDateAfter($field, $value, $params)
    {
        $vtime = ($value instanceof \DateTime) ? $value->getTimestamp() : strtotime($value);
        $ptime = ($params[0] instanceof \DateTime) ? $params[0]->getTimestamp() : strtotime($params[0]);

        return $vtime > $ptime;
    }

    protected function validateBoolean($field, $value)
    {
        return (is_bool($value)) ? true : false;
    }

    public function data()
    {
        return $this->_fields;
    }

    public function errors($field = null)
    {
        if ($field !== null) {
            return isset($this->_errors[$field]) ? $this->_errors[$field] : false;
        }

        return $this->_errors;
    }

    public function error($field, $msg, array $params = array())
    {
        $msg = $this->checkAndSetLabel($field, $msg, $params);

        $values = array();
        // Printed values need to be in string format
        foreach ($params as $param) {
            if (is_array($param)) {
                $param = "['" . implode("', '", $param) . "']";
            }
            if ($param instanceof \DateTime) {
                $param = $param->format('Y-m-d');
            } else {
                if (is_object($param)) {
                    $param = get_class($param);
                }
            }
            // Use custom label instead of field name if set
            if (is_string($params[0])) {
                if (isset($this->_labels[$param])) {
                    $param = $this->_labels[$param];
                }
            }
            $values[] = $param;
        }

        $this->_errors[$field][] = vsprintf($msg, $values);
    }

    public function message($msg)
    {
        $this->_validations[count($this->_validations) - 1]['message'] = $msg;

        return $this;
    }

    public function reset()
    {
        $this->_fields = array();
        $this->_errors = array();
        $this->_validations = array();
        $this->_labels = array();
    }

    protected function getPart($data, $identifiers)
    {
        // Catches the case where the field is an array of discrete values
        if (is_array($identifiers) && count($identifiers) === 0) {
            return array($data, false);
        }

        $identifier = array_shift($identifiers);

        // Glob match
        if ($identifier === '*') {
            $values = array();
            foreach ($data as $row) {
                list($value, $multiple) = $this->getPart($row, $identifiers);
                if ($multiple) {
                    $values = array_merge($values, $value);
                } else {
                    $values[] = $value;
                }
            }

            return array($values, true);
        }

        // Dead end, abort
        elseif ($identifier === NULL || ! isset($data[$identifier])) {
            return array(null, false);
        }

        // Match array element
        elseif (count($identifiers) === 0) {
            return array($data[$identifier], false);
        }

        // We need to go deeper
        else {
            return $this->getPart($data[$identifier], $identifiers);
        }
    }

    public function validate()
    {
        foreach ($this->_validations as $v) {
            foreach ($v['fields'] as $field) {
                list($values, $multiple) = $this->getPart($this->_fields, explode('.', $field));

                // Don't validate if the field is not required and the value is empty
                if ($v['rule'] !== 'required' && !$this->hasRule('required', $field) && (! isset($values) || $values === '' || ($multiple && count($values) == 0))) {
                    continue;
                }

                // Callback is user-specified or assumed method on class
                if (isset(static::$_rules[$v['rule']])) {
                    $callback = static::$_rules[$v['rule']];
                } else {
                    $callback = array($this, 'validate' . ucfirst($v['rule']));
                }

                if (!$multiple) {
                    $values = array($values);
                }

                $result = true;
                foreach ($values as $value) {
                    $result = $result && call_user_func($callback, $field, $value, $v['params']);
                }

                if (!$result) {
                    $this->error($field, $v['message'], $v['params']);
                }
            }
        }

        return count($this->errors()) === 0;
    }

    public function validateWithTry()
    {
        if($this->validate()) {
            throw new Exception($this->firstError());
        }
    }

    protected function hasRule($name, $field)
    {
        foreach ($this->_validations as $validation) {
            if ($validation['rule'] == $name) {
                if (in_array($field, $validation['fields'])) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function addRule($name, $callback, $message = self::ERROR_DEFAULT)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Second argument must be a valid callback. Given argument was not callable.');
        }

        static::$_rules[$name] = $callback;
        static::$_ruleMessages[$name] = $message;
    }

    public function rule($rule, $fields)
    {
        if (!isset(static::$_rules[$rule])) {
            $ruleMethod = 'validate' . ucfirst($rule);
            if (!method_exists($this, $ruleMethod)) {
                throw new \InvalidArgumentException("Rule '" . $rule . "' has not been registered with " . __CLASS__ . "::addRule().");
            }
        }

        // Ensure rule has an accompanying message
        $message = isset(static::$_ruleMessages[$rule]) ? static::$_ruleMessages[$rule] : self::ERROR_DEFAULT;

        // Get any other arguments passed to function
        $params = array_slice(func_get_args(), 2);

        $this->_validations[] = array(
            'rule' => $rule,
            'fields' => (array) $fields,
            'params' => (array) $params,
            'message' => '{field} ' . $message
        );

        return $this;
    }

    public function label($value)
    {
        $lastRules = $this->_validations[count($this->_validations) - 1]['fields'];
        $this->labels(array($lastRules[0] => $value));

        return $this;
    }

    public function labels($labels = array())
    {
        $this->_labels = array_merge($this->_labels, $labels);

        return $this;
    }

    private function checkAndSetLabel($field, $msg, $params)
    {
        if (isset($this->_labels[$field])) {
            $msg = str_replace('{field}', $this->_labels[$field], $msg);

            if (is_array($params)) {
                $i = 1;
                foreach ($params as $k => $v) {
                    $tag = '{field'. $i .'}';
                    $label = isset($params[$k]) && (is_numeric($params[$k]) || is_string($params[$k])) && isset($this->_labels[$params[$k]]) ? $this->_labels[$params[$k]] : $tag;
                    $msg = str_replace($tag, $label, $msg);
                    $i++;
                }
            }
        } else {
            $msg = str_replace('{field}', ucwords(str_replace('_', ' ', $field)), $msg);
        }

        return $msg;
    }

    public function rules($rules)
    {
        foreach ($rules as $ruleType => $params) {
            if (is_array($params)) {
                foreach ($params as $innerParams) {
                    array_unshift($innerParams, $ruleType);
                    call_user_func_array(array($this, 'rule'), $innerParams);
                }
            } else {
                $this->rule($ruleType, $params);
            }
        }
    }

    /**
     * 获取第一个错误的错误说明（errors方法只能回去所有错误的数组）
     * @return string
     */
    public function firstError() {
        $errors = $this->errors();
        if (!empty($errors)) {
            foreach ($errors as $error) {
                return $error[0];
            }
        }
        return false;
    }

}