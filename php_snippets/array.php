<?php

// Find the value of a Key
function seekKey($haystack, $needle){
    foreach($haystack as $key => $value){
        if($key == $needle){
            $output = $value;
        }elseif(is_array($value)){
            $output = seekKey($value, $needle);
        }
    }
    return $output;
}

// Find the Key that matches the Value
function seekValue($haystack, $needle){
    foreach($haystack as $key => $value){
        if($key == $needle){
            $output = $value;
        }elseif(is_array($value)){
            $output = seekValue($value, $needle);
        }
    }
    return $output;
}

function seekAndDestroy($haystack, $needle){
    foreach($haystack as $key => $value){
        if($key == $needle){
            unset($key);
        }elseif(is_array($value)){
            $output[$key] = seekAndDestroy($value, $needle);
        }else{
            $output[$key] = $value;
        }
    }
    return $output;
}


function seekAndRename($haystack, $needle, $new){
    foreach($haystack as $key => $value){
        if($key == $needle){
            $output[$new] = $value;
        }elseif(is_array($value)){
            $output[$key] = seekAndRename($value, $needle, $new);
        }else{
            $output[$key] = $value;
        }
    }
    return $output;
}

<?php

/**
 * Recursively converts a SimpleXML object (and children) to an array.
 *
 * @return - array
 * @param - $xml - XML Object to be converted to array
 *
 */
function xmlToArr($xml)
{
    if (empty($xml))
    {
        return "";
    }
    $xml = (array) $xml;
    foreach ($xml as &$val)
    {
        if (get_class($val) == "SimpleXMLElement")
        {
            $val = xmlToArr($val);
        }
    }
    return $xml;
}


/**
 * Refresh Current page after
 * @param  integer $seconds Number of seconds to refresh after
 */
function refresh($seconds=10)
{
    header("Refresh:".$seconds.";");
}


/**
 * Returns array of all URL in input string
 * @return array
 * @param $string text to search
 */
function extractURL($string)
{
    $regexp = "/<a[^>]+href=[\"|']([^\"]+)[\"|']>[^<]+<\/a>/";
    preg_match_all(Trigger::current()->filter($regexp, "link_regexp"), stripslashes($string), $matches);
    $matches = $matches[1];
    return $matches;
}

class Trigger {
    public static $instance;
    public static function current() {
        if (self::$instance == null) {
            self::$instance = new Trigger();
        }
        return self::$instance;
    }

    public function filter($regexp, $type){

    }
}



/**
 * Returns the IP address .
 * @return  string
 */
function getClientIP()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
    {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    }
    elseif(getenv('HTTP_X_FORWARDED_FOR'))
    {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif(getenv('HTTP_X_FORWARDED'))
    {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    }
    elseif(getenv('HTTP_FORWARDED_FOR'))
    {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    }
    elseif(getenv('HTTP_FORWARDED'))
    {
        $ipaddress = getenv('HTTP_FORWARDED');
    }
    elseif(getenv('REMOTE_ADDR'))
    {
        $ipaddress = getenv('REMOTE_ADDR');
    }
    else
    {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}



/**
 * Return true for a valid email address
 * else returns false
 * @return bool
 * @param $email string
 **/
function validateEmail($email)
{
    if (!preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/", $email))
    {
        return false;
    }
    else
    {
        return true;
    }
}



/**
 * Return credit card type if number is valid
 * @return string
 * @param $number string
 **/
function cardType($number)
{
    $number=preg_replace('/[^\d]/','',$number);
    if (preg_match('/^3[47][0-9]{13}$/',$number))
    {
        return 'American Express';
    }
    elseif (preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',$number))
    {
        return 'Diners Club';
    }
    elseif (preg_match('/^6(?:011|5[0-9][0-9])[0-9]{12}$/',$number))
    {
        return 'Discover';
    }
    elseif (preg_match('/^(?:2131|1800|35\d{3})\d{11}$/',$number))
    {
        return 'JCB';
    }
    elseif (preg_match('/^5[1-5][0-9]{14}$/',$number))
    {
        return 'MasterCard';
    }
    elseif (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/',$number))
    {
        return 'Visa';
    }
    else
    {
        return 'Unknown';
    }
}



/**
 * Get the URL of current page open in browser
 * @return string
 **/
function getCurrentURL()
{
    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    return $url;
}


function trimText($inputText, $start, $length)
{
    $temp = $inputText;
    $res = array();
    while(strpos($temp,'>'))
    {
        $ts = strpos($temp,'<');
        $te = strpos($temp,'>');
        if($ts >0)
        {
            $res[]= substr($temp,0, $ts);
        }
        $res[]= substr($temp, $ts, $te - $ts +1);
        $temp = substr($temp, $te +1, strlen($temp)- $te);
    }
    if($temp !='')
    {
        $res[]= $temp;
    }
    $pointer =0;
    $end = $start + $length -1;
    foreach($res as &$part)
    {
        if(substr($part,0,1)!='<')
        {
            $l = strlen($part);
            $p1 = $pointer;
            $p2 = $pointer + $l -1;
            $partx ="";
            if($start <= $p1 && $end >= $p2)
            {
                $partx ="";
            }
            else
            {
                if($start > $p1 && $start <= $p2)
                {
                    $partx .= substr($part,0, $start-$pointer);
                }
                if($end >= $p1 && $end < $p2)
                {
                    $partx .= substr($part, $end-$pointer+1, $l-$end+$pointer);
                }
                if($partx =="")
                {
                    $partx = $part;
                }
            }
            $part = $partx;
            $pointer += $l;
        }
    }
    return join('', $res);
}




