<?php
// $filter = new Filter;
// $filter->validate('name')->inValues(array(1, 2))->message('名称只能1或则2');
// $status = $filter->applay(); var_dump($filter->getMessages();
class Filter
{
	private $data;
	public $vlidateClass = array();
	public $temFileld;
	public $errorMessage; 

	public function __construct(){
		$this->data = array('name'=> 'c'); 
	}

	public function getMessages() {
         return $this->errorMessage;
	}
	
	public function validate($fileld){
		$this->temFileld = $fileld;
		return $this;
	}
	
	public function __call($class, $params) {

		if (!isset($this-validateClass[$this->tmFiled])){
			$this->validateClass[$this->temFiled] = array();	
		}

		$this->validateClass$[$this->temFiled][] = new $class($params);
		$currentValidateClass = current($this->validateClass);
		$currentValidateClass->setFileld($this->temFileld);
		return current($this->validateClass);
	}

	public function apply(){
		foreach($this->validateClass as $filed => $class){
			!$class->validate($this->data[$filed]) && $this->errorMessage = $class->errorMessage;
		}
	}
}

class Required() {
	public $errorMessage;
	public $rule;

	public function __construct($params){
		$this->rule = $params;
	}

	public function validate($value){
		return !trim($value) == '';
	}
}

class 

class InValues
{
	public $errorMessage;
	public $inArray;

	public function __construct($params){
		$this->inArray = $params;
	}

	public function validate($value) 
	{
		return	in_array($value, $this->inArray);
	}

	public function message($message){
		$this->errorMessage = $message;
	}

}


$filter = new Filter;
$filter->validate('name')->inValues(array('a', 'b'))->message('name只能a，b');
$status = $filter->apply();

if (!$status) {
	var_dump($filter->getMessages());
}
