<?php
// is_callable 的意思是可以调用的到
// callable TEST

class A {
    public function test() {

    }
}

$nimingFuntion = function() {

};
function AF() {

}
var_dump(is_callable(['A', 'test']));
var_dump(is_callable($nimingFuntion));
var_dump(is_callable('AF'));
// true
// true
// true
// Closure 代表匿名函数
var_dump(($nimingFuntion instanceof \Closure));



// Array callable
if (is_array($callable)) {
    list($class, $method) = $callable;
    return new \ReflectionMethod($class, $method);
}
// Closure
if ($callable instanceof \Closure) {
    return new \ReflectionFunction($callable);
}
// Callable object (i.e. implementing __invoke())
if (is_object($callable) && method_exists($callable, '__invoke')) {
    return new \ReflectionMethod($callable, '__invoke');
}
// Callable class (i.e. implementing __invoke())
if (is_string($callable) && class_exists($callable) && method_exists($callable, '__invoke')) {
    return new \ReflectionMethod($callable, '__invoke');
}
// Standard function
return new \ReflectionFunction($callable);