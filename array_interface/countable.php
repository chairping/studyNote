<?php
/**
 * Created by PhpStorm.
 * User: cp
 * Date: 15-7-30
 * Time: 下午11:21
 */

class Collection implements Countable
{
    /**
     * Count the number of items in the Collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }
}

$colours = new Collection(['red', 'blue', 'green']);

count($colours); // 3