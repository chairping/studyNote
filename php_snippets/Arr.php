<?php

namespace Carbon;

class Arr
{
//  $array = [
//      '1' => 'a',
//      '2' => ['3' => 'c']
//  ];
//
//  $a = Arr::get($array, '2.3');
//  var_dump($a); out  'c'
    public static function get($array, $key, $default = null)
    {
        if (is_null($key)) return $array;

        if (isset($array[$key])) return $array[$key];

        foreach (explode('.', $key) as $segment)
        {
            if ( ! is_array($array) || ! array_key_exists($segment, $array))
            {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }


    public static function divide($array)
    {
        return array(array_keys($array), array_values($array));
    }

//  $array = [
//      '1' => 'a',
//      '2' => ['3' => 'c']
//  ];
//  $a = Arr::set($array, '1.2.3', 'cc');
//  var_dump($a);
//  var_dump($array);
//array (size=2)
//    1 =>
//        array (size=1)
//            2 =>
//                array (size=1)
//                    3 => string 'cc' (length=2)
//    2 =>
//        array (size=1)
//            3 => string
    public static function set(&$array, $key, $value)
    {
        if (is_null($key)) return $array = $value;

        $keys = explode('.', $key);

        while (count($keys) > 1)
        {
            $key = array_shift($keys);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if ( ! isset($array[$key]) || ! is_array($array[$key]))
            {
                $array[$key] = array();
            }

            $array =& $array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }
    // ��������array_map ���� ���ǿ��Կ���key
    public static function build($array, Closure $callback)
    {
        $results = array();

        foreach ($array as $key => $value)
        {
            list($innerKey, $innerValue) = call_user_func($callback, $key, $value);

            $results[$innerKey] = $innerValue;
        }

        return $results;
    }

//array (size=2)
//0 => string 'a' (length=1)
//'2.3' => string 'c' (length=1)
    public static function dot($array, $prepend = '')
    {
        $results = array();

        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                $results = array_merge($results, static::dot($value, $prepend.$key.'.'));
            }
            else
            {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }

    // ���ز
    public static function except($array, $keys)
    {
        return array_diff_key($array, array_flip((array) $keys));
    }

//$array = [
//'1' => ['a' => array('xxx'=> 3)],
//'2' => ['a' => 'c'],
//'3' => ['b' => 'c']
//];
//$a = Arr::fetch($array, 'a.xxx');
//array (size=1)
//0 => int 3   ����ָ����ֵ
    public static function fetch($array, $key)
    {
        foreach (explode('.', $key) as $segment)
        {
            $results = array();

            foreach ($array as $value)
            {
                if (array_key_exists($segment, $value = (array) $value))
                {
                    $results[] = $value[$segment];
                }
            }

            $array = array_values($results);//var_dump($array);
        }

        return array_values($results);
    }
    //  ���ط��������ĵ�һ��ֵ
    public static function first($array, $callback, $default = null)
    {
        foreach ($array as $key => $value)
        {
            if (call_user_func($callback, $key, $value)) return $value;
        }

        return value($default);
    }

    // ���ط������������һ��ֵ
    public static function last($array, $callback, $default = null)
    {
        return static::first(array_reverse($array), $callback, $default);
    }

    // �Ѷ༶���黯�ɵ�һ����
    public static function flatten($array)
    {
        $return = array();

        array_walk_recursive($array, function($x) use (&$return) { $return[] = $x; });

        return $return;
    }
    // ɾ��ָ���㼶��ֵ
    public static function forget(&$array, $keys)
    {
        $original =& $array;

        foreach ((array) $keys as $key)
        {
            $parts = explode('.', $key);

            while (count($parts) > 1)
            {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part]))
                {
                    $array =& $array[$part];
                }
            }

            unset($array[array_shift($parts)]);

            // clean up after each pass
            $array =& $original;
        }
    }
    // ���ؼ����Ľ���
    public static function only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    public static function pluck($array, $value, $key = null)
    {
        $results = array();

        foreach ($array as $item)
        {
            $itemValue = is_object($item) ? $item->{$value} : $item[$value];

            // If the key is "null", we will just append the value to the array and keep
            // looping. Otherwise we will key the array using the value of the key we
            // received from the developer. Then we'll return the final array form.
            if (is_null($key))
            {
                $results[] = $itemValue;
            }
            else
            {
                $itemKey = is_object($item) ? $item->{$key} : $item[$key];

                $results[$itemKey] = $itemValue;
            }
        }

        return $results;
    }

}