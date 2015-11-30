<?php
// 装饰类 多层
// 抽象基类
abstract class IComponent {
	protected $date;
	protected $ageGroup;
	protected $feature;
	abstract public function getDate();
	abstract public function setAge($ageNow);
	abstract public function getAge();
	abstract public function setFeature($fea);
	abstract public function getFeature();
}
// 抽象继承抽象 实现了部分方法
abstract class Decorator extends IComponent {
	public function getDate() {
		if($this->date != null) {
			$this->date->getDate();
		}
	}
	public function setAge($ageNow) {
		$this->ageGroup = $this->ageGroup;
	}
	public function getAge() {
		return $this->ageGroup;
	}
}

class Male extends IComponent {
	public function __construct(){
		$this->date="Male";
		$this->setFeature("<br/>Dude programmer features: ");
	}
	public function getDate(){
		return $this->date;
	}
	public function getAge(){
		return $this->ageGroup;
	}
	public function setAge($ageNow){
		$this->ageGroup = $ageNow;
	}
	public function getFeature(){
		return $this->feature;
	}
	public function setFeature($fea){
		$this->feature = $fea;
	}
}

class Female extends IComponent {
	public function __construct(){
		$this->date="Female";
		$this->setFeature("<br/>Grrrl programmer features: ");
	}
	public function getDate(){
		return $this->date;
	}
	public function getAge(){
		return $this->ageGroup;
	}
	public function setAge($ageNow){
		$this->ageGroup=$ageNow;
	}
	public function getFeature(){
		return $this->feature;
	}
	public function setFeature($fea){
		$this->feature=$fea;
	}
}

class Food extends Decorator {
	private $chowNow;
	public function __construct(IComponent $dateNow) {
		$this->date = $dateNow;
		$this->getDate();
	}
	private $snacks=array(
		"piz"=>"Pizza",
		"burg"=>"Burgers",
		"nach"=>"Nachos",
		"veg"=>"Veggies"
	);

	public function setFeature($yum) {
		$this->chowNow = $this->snacks[$yum];
	}
	public function getFeature() {
		$output=$this->date->getFeature();
		$fmat="<br/>&nbsp;&nbsp;";
		$output .="$fmat Favorite food: ";
		$output .= $this->chowNow . "<br/>";
		return  $output;
	}
}

class Hardware extends Decorator {
	private $hardwareNow;
	public function __construct(IComponent $dateNow) {
		$this->date = $dateNow;
		$this->getDate();
	}
	private $box=array(
		"mac"=>"Macintosh",
		"dell"=>"Dell",
		"hp"=>"Hewlett-Packard",
		"lin"=>"Linux"
	);
	public function setFeature($hdw) {
		$this->hardwareNow=$this->box[$hdw];
	}
	public function getFeature() {
		$output=$this->date->getFeature();
		$fmat="<br/>&nbsp;&nbsp;";
		$output .="$fmat Current Hardware: ";
		$output .= $this->hardwareNow;
		return  $output;
	}
}

class ProgramLang extends Decorator
{
	private $languageNow;
	public function __construct(IComponent $dateNow){
		$this->date = $dateNow;
		$this->getDate();
	}
	private $language = array(
		"php"=>"PHP",
		"cs"=>"C#",
		"js"=>"JavaScript",
		"as3"=>"ActionScript 3.0"
	);
	public function setFeature($lan){
		$this->languageNow=$this->language[$lan];
	}
	public function getFeature(){
		$output=$this->date->getFeature();
		$fmat="<br/>&nbsp;&nbsp;";
		$output .="$fmat Preferred programming language: ";
		$output .= $this->languageNow;
		return  $output;
	}
}

class ClientH {
	//$hotDate is component instance
	private $hotDate;
	private $progLange;
	private $hardware;
	private $food;
	public function __construct() {
		$gender=$_POST["gender"];
		$age=$_POST["age"];
		$this->progLang=$_POST["progLang"];
		$this->hardware=$_POST["hardware"];
		$this->food=$_POST["food"];

		$this->hotDate = new $gender();
		$this->hotDate->setAge($age);
		echo $this->hotDate->getDate() . "<br/>";
		echo $this->hotDate->getAge();
		$this->hotDate = $this->wrapComponent($this->hotDate);
		echo $this->hotDate->getFeature();
	}

	private function wrapComponent(IComponent $component) {
		$component = new ProgramLang($component);
		$component->setFeature($this->progLang);
		$component = new Hardware($component);
		$component->setFeature($this->hardware);
		$component = new Food($component);
		$component->setFeature($this->food);
		return $component;
	}
}
$worker=new ClientH()
?>
