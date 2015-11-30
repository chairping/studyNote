<?php
class Str
{
    /**
     * 限制字符串长度
     * @param string $value  需切断的字符串
     * @param int $limit     长度
     * @param string $end    后缀
     * @return string
     */
    public static function limit($value, $limit = 100, $end = '...') {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }
        // 第三个参数不用是为了防止截取的最后一个字符是空白符
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }

    /**
     * 快速生成随机数
     * @param int $length
     * @return string
     */
    public static function quickRandom($length = 16) {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /** 生成数字,大小写字母组成的任意位数的字符串 random($min_len,$max_len,$t)
       * @param  $min_len  字符串最小长度
       * @param  $max_len    字符串最大长度
       * @param  $type       生成的字符串类别
       *                     0为全部小写和数字的组合,
                             1为全部大写和数字的组合,
                             3为全部数字的组合,
                             4为大小写字母的组合
       * @return string
       */
      public static function random($min_len=9, $max_len=9, $type=3){
          $str_len = mt_rand($min_len, $max_len);
          $ps = "";
          while(strlen($ps) < $str_len){
              $r = array(
                      mt_rand(49,57),//1-9的ASCII码
                      mt_rand(65,90),//A-Z的ASCII码
                      mt_rand(97,122)//a-z的ASCII码
                  );

              if($type == 3) $tmp = chr($r[mt_rand(0,0)]);
              else $tmp = chr($r[mt_rand(0,2)]);
              if($type == 0)
                  $tmp = strtolower($tmp);
              else
                  $tmp = $type==1?strtoupper($tmp):$tmp;
              $ps .= $tmp;
          }
          return trim($ps);
      }

    /**
     * 检测是否以某个字符串结尾的
     * @param $haystack
     * @param $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles) {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }
        return false;
    }

    public static function substr($string, $start, $length = null) {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
	 * 检查一段utf-8编码的字符串是否为中文
	 * @param $sourceString	被检查的字符串
	 * @return boolean		如果是，返回true，否则返回false
	 */
	public static function isChinese_utf8($string) {
		return preg_match('/^[\x7f-\xff]+$/', $string);
	}

    /**
	 * 将相差timestamp转为如“1分钟前”，“3天前”等形式
	 * @param timestamp $ts_diff 当前时间 - 要格式化的timestamp
	 */
	public static function formatTime($ts_diff) {
		if ($ts_diff <=0) {
			return date('Y-m-d');
		} elseif ( $ts_diff <= 3600 ) {
			return max(1, (int)($ts_diff/60)) . '分钟前';
		} elseif ( $ts_diff <= 86400 ) {
			return ((int)($ts_diff/3600)) . '小时前';
		} else {
			return ((int)($ts_diff/86400)) . '天前';
		}
	}
}
