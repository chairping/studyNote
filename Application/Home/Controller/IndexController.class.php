<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function _initialize() {
//        \Think\Hook::add('action_begin', 'Home\\Behaviors\\B\\testBehavior');
    }

    public function dummy(){
        return 1;
    }
    public function index(){
        var_dump(dummy());
//        return M('country')->select();
//        M('x')->select();
//        foreach(filter_list() as $id => $filter) {
//            echo $filter . ' ' . filter_id($filter) . "</br >";
//        }
//
//        $int = '1234'; // or $int = 1234;
//        echo filter_var($int, FILTER_VALIDATE_INT); // output: 1234 if $int = 'abc1234' output:false
//
//        $int = 42;
//        $min = 50;
//        $max = 100;
//        echo filter_var($int, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, "max_range" => $max]]);// 42< x < 100

//        dump($this->config);
//        tag('a', $ab);
//        dump($ab);
//        T();
//        function Factorial($i=1) {
//            return($i==1?1:$i*Factorial($i-1));
//        }
//        $time = microtime( true );
//        echo Factorial(10);
//        echo( "Variable functions took " . (microtime( true ) - $time) . " seconds.<br />" );
//        \Think\Build::checkDir('Tph');
//        $time = microtime( true );
//       $A =  memory_get_usage();
//        function fab($n) {
//            echo "-- n = $n ----------------------------".PHP_EOL;
//            debug_print_backtrace();
//            if ($n == 1 || $n == 0) {
//                return $n;
//            }
//            return call_user_func(__FUNCTION__,$n-1) + call_user_func(__FUNCTION__,$n-2);
//        }
//
//        fab(20);
//        echo( "Variable functions took " . (microtime( true ) - $time) . " seconds.<br />" );
//
//        $b =  memory_get_usage();
//
//        dump($b-$A);
//
//        $time = microtime( true );
//        $A =  memory_get_usage();
//        function fab1($n) {
//            echo "-- n = $n ----------------------------".PHP_EOL;
//            debug_print_backtrace();
//            if ($n == 1 || $n == 0) {
//                return $n;
//            }
//            return fab1($n-1) + fab1($n-2);
//        }
//
//        fab1(20);
//        echo( "Variable functions took " . (microtime( true ) - $time) . " seconds.<br />" );
//        $b =  memory_get_usage();
//
//        dump($b-$A);
//        echo G('begin','end','m').'kb';
//        $array = [[1,2],[3,4]];

//        foreach($array as $key => $val) {
//            $a = $val[0]; $b = $val[1];
//            echo "A: $a; B: $b\n";
//        }
//        foreach ($array as list($a, $b)) {
//            echo "A: $a; B: $b\n";
//        }

//        function xrange() {
//            $array = [[1,2],[3,4]];
//            for ($i = $start; $i <= $limit; $i += $step) {
//                yield $array;
//            }
//        }
//        var_dump(xrange());
//        echo 'Single digit odd numbers: ';
        /*
         * Note that an array is never created or returned,
         * which saves memory.
         */
//        var_dump(yield);
//        foreach (yield as $number) {
//            echo "$number ";
//        }
//        var_dump(is_callable('xx'));
//        call_user_func('xx');
//        $a = 'xx';
//        $a();

//        echo "\n";

//        \Think\Route::check();
        $this->display();
    }

    public function menu() {
        $this->a = array(5,'thinkphp');
        $this->display();
    }

    public function typeClumn() {
        // $string = 'sdfsd';
        // echo ctype_alnum($string);
        // var_dump(mb_strlen($string, '8bit'));
        // var_dump(mb_strlen($string, 'utf-8'));
        // var_dump(strlen($string));

        // var_dump(mb_internal_encoding());
        var_dump( substr( 'abc', 5, 2 ) ); // returns "false"
        var_dump( mb_substr( 'abc', 5, 2 ) ); // returns ""
    }
    
}