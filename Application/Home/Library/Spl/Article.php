<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-8
 * Time: 下午6:55
 */

class Article implements ArrayAccess, IteratorAggregate {
    public $title;
    public $author;
    public $category;

    public function __construct($title, $authoer, $category) {
        $this->title = $title;
        $this->author = $authoer;
        $this->category = $category;
    }

    public function offsetSet($key, $value) {
        if (array_key_exists($key, get_object_vars($this))) {
            $this->{$key} = $value;
        }
    }

    public function offsetGet($key) {
        if (array_key_exists($key, get_object_vars(this))) {
            return $this->{$key};
        }
    }

    public function offsetUnset($key) {
        if (array_key_exists($key, get_object_vars($this))) {
            unset($this->{$key});
        }
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, get_object_vars($this));
    }

    public function getIterator() {
        return new ArrayIterator($this);
    }
}

// Create the object
$A = new Article('SPL Rocks','Joe Bloggs', 'PHP');

// Check what it looks like
echo 'Initial State:<div>';
print_r($A);
echo '</div>';

// Change the title using array syntax
$A['title'] = 'SPL _really_ rocks';

// Try setting a non existent property (ignored)
$A['not found'] = 1;

// Unset the author field
unset($A['author']);

// Check what it looks like again
echo 'Final State:<div>';
print_r($A);
echo '</div>';


$A = new Article('SPL Rocks','Joe Bloggs', 'PHP');

// Loop (getIterator will be called automatically)
echo 'Looping with foreach:<div>';
foreach ( $A as $field => $value ) {
    echo "$field : $value<br>";
}
echo '</div>';

// Get the size of the iterator (see how many properties are left)
echo "Object has ".sizeof($A->getIterator())." elements";


/*** a simple array ***/
$array = array('koala', 'kangaroo', 'wombat', 'wallaby', 'emu', 'kiwi', 'kookaburra', 'platypus');

/*** create the array object ***/
$arrayObj = new ArrayObject($array);

/*** iterate over the array ***/
for($iterator = $arrayObj->getIterator();
    /*** check if valid ***/
    $iterator->valid();
    /*** move to the next array member ***/
    $iterator->next())
{
    /*** output the key and current array value ***/
    echo $iterator->key() . ' => ' . $iterator->current() . '<br />';
}


$arrayObj->append('dingo');
$arrayObj->natcasesort();
echo $arrayObj->count();
$arrayObj->offsetUnset(5);
if ($arrayObj->offsetExists(3))
{
    echo 'Offset Exists<br />';
}
$arrayObj->offsetSet(5, "galah");

echo $arrayObj->offsetGet(4);

/*** a simple array ***/
$array = array('koala', 'kangaroo', 'wombat', 'wallaby', 'emu', 'kiwi', 'kookaburra', 'platypus');

try {
    $object = new ArrayIterator($array);
    foreach($object as $key=>$value)
    {
        echo $key.' => '.$value.'<br />';
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}
