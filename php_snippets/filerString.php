<?php


/**
 * @desc  过滤字符串
 * @param string $str      要过滤的字符串
 * @param string $tag      符合过滤条件的标记
 * @return string          返回过滤后的字符串
 * @eample
 *      $string = <<<STR   /**
 *          *  @desc  过滤字符串
 *          *   @param string $str      要过滤的字符串
 *          *\/
 *      STR;
 *      $this->getDocComment($string, '@desc');  // output: 过滤字符串
 */
function getDocComment($str, $tag = '') {
    if (empty($tag))
    {
        return $str;
    }

    $matches = array();
    preg_match("/".$tag." (.*)(\\r\\n|\\r|\\n)/U", $str, $matches);

    if (isset($matches[1]))
    {
        return trim($matches[1]);
    }

    return '';
}