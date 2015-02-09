<?php

/**
 * 定义一个被观察者
 */
class TestSubject implements SplSubject {

    private $_observers;
    private $_status = 0;

    /*** Attach an SplObserver 绑定观察者
    */
    public function attach(SplObserver $observer) {
        $index = array_search($observer, $this->_observers);
        if ($index !== false) {
            unset($this->_observers[$index]);
        }
    }
//  取消绑定观察者
    public function detach(SplObserver  $observer) {
        $index = array_search($observer, $this->_observers);
        if($index !== false) {
            unset($this->_observers[$index]);
        }
    }

//通知观察者
    public function notify() {
        if (!empty($this->_observers)) {
            foreach ($this->_observers as $observer) {
                $observer->update($this);
            }
        }
    }

    public function getStatus() {
        return $this->_status;
    }

    public function setStatus($status) {
        $this->_status = $status;
        $this->notify();
    }
}

class TestObserver1 implements SplObserver {
    public function update(SplSubject $subject) {
        echo "<br>[Observer1]: The Subject status changed to :" , $subject->getStatus();
    }
}

class TestObserver2 implements SplObserver{

    public function update(SplSubject $subject) {
        echo "<br>[Observer2]: The Subject status changed to :" , $subject->getStatus();
    }
}

$subject = new TestSubject();
$subject->attach(new TestObserver1());
$subject->attach(new TestObserver2());
$subject->setStatus(1);