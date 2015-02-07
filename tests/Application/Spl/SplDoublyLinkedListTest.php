<?php

class SplDoublyLinkedListTest extends PHPUnit_Framework_TestCase {

    public function test1() {
        $obj = new SplDoublyLinkedList();

        $obj->push(0);
        $obj->push(1);
        $obj->push(2);

        $obj->unshift(10);
        $obj->unshift(11);

        /**
         *  因为指针还未初始化 所以
         *  1. 当前指针是否有效为 FALSE
         *  2. 直接获取当前指针的值会是 NULL
         */
        $this->assertEquals(false, $obj->valid());
        $this->assertEquals(null, $obj->current());

        $obj->rewind();
        // 将指针重置之后，第一个肯定是 11 ，因为它是在最后执行了一个
        // 将 11 插入到链表最前面的一个函数 unshift
        $this->assertEquals(11, $obj->current());

        $obj->next();
        // 11 下面应该是 10
        $this->assertEquals(10, $obj->current());

        // (下一个 下一个 上一个) === (下一个)
        $obj->next(); // 0
        $obj->next(); // 1
        $obj->prev(); // 0
        $this->assertEquals(0, $obj->current());

        $obj->next(); // 1
        $obj->next(); // 2
        $obj->next(); // 已经超过最大的了，使用 valid 判断应该是 false
        $this->assertEquals(false, $obj->valid());
    }

    public function test2() {
        $obj = new SplDoublyLinkedList();
        // Pushes value at the end of the doubly linked list.
        $obj->push(0);
        $obj->push(1);
        $obj->push(2);

        // Prepends value at the beginning of the doubly linked list.
        $obj->unshift(10);
        $obj->unshift(11);

        // 获取最后一个节点的值
        $this->assertEquals(2, $obj->top());
        // 获取第一个节点的值
        $this->assertEquals(11, $obj->bottom());
    }

    public function test3() {
        $obj = new SplDoublyLinkedList();

        $this->assertEquals(true, $obj->isEmpty());

        $obj->unshift('string');
        // 这里已经有值了就应该是 false
        $this->assertEquals(false, $obj->isEmpty());

        // 这时再使用 pop 弹出最后一个就应该是 'string'
        $this->assertEquals('string', $obj->pop());
    }


    /**
     * 如果是空的时候试图 pop 弹出最后一个节点的值则会 抛出一个 RuntimeException
     *
     * @expectedException RuntimeException
     */
    public function testRuntimeException(){
        $obj = new SplDoublyLinkedList();
        $obj->pop();
    }

    public function testOffset(){
        $obj = new SplDoublyLinkedList();
        $obj->push('one');
        $obj->push('two');
        $obj->unshift('three');

        // 下标是从0 开始的 所以现在3 应该是不存在的
        $this->assertEquals(false, $obj->offsetExists(3));

        // 下标为2 的应该是存在的
        $this->assertEquals(true, $obj->offsetExists(2));

        $this->assertEquals('two', $obj->offsetGet(2));

        // 删除下标为0 的值
        $obj->offsetUnset(0);
        // 删除为 0 的值之后，后面的都会向前移一位
        // 所以现在的顺序为： one two
        $obj->rewind();
        $this->assertEquals('one', $obj->current());
        $this->assertEquals(0, $obj->key());

        $obj->next();
        $this->assertEquals('two', $obj->current());
        $this->assertEquals(1, $obj->key());
        // 并且总个数为 2
        $this->assertEquals(2, $obj->count());
    }

    public function testAdd(){
        $obj = new SplDoublyLinkedList();
        $obj->push('one');
        $obj->push('two');
        $obj->push('three');
        $obj->unshift('four');
        $obj->add(1, 'five');

        // 这时候的顺序应该是：
        // four five one two three

        $obj->rewind();
        $this->assertEquals('four', $obj->current());
        $obj->next();
        $this->assertEquals('five', $obj->current());
        $obj->next();
        $this->assertEquals('one', $obj->current());
        $obj->next();
        $this->assertEquals('two', $obj->current());
        $obj->next();
        $this->assertEquals('three', $obj->current());
    }
} 