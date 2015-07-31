<?php
/**
 * Created by PhpStorm.
 * User: cp
 * Date: 15-7-30
 * Time: 下午11:22
 */

class Collection implements IteratorAggregate
{
    /**
     * Get an iterator for the items
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}
$colours = new Collection(['red', 'green', 'blue']);
foreach ($colours as $colour) {
    // Do something
}
