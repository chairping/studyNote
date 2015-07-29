<?php

echo preg_replace_callback('~-([a-z])~', function ($match) {
    return strtoupper($match[1]);
}, 'hello-world');
// outputs helloWorld


$greet = function($name)
{
    printf("Hello %s\r\n", $name);
};
$greet('World');
$greet('PHP');





$callback =
    function ($quantity, $product) use ($tax, &$total)
    {
        $pricePerItem = constant(__CLASS__ . "::PRICE_" .
            strtoupper($product));
        $total += ($pricePerItem * $quantity) * ($tax + 1.0);
    };

array_walk($this->products, $callback);