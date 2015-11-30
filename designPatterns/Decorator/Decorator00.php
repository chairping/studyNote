<?php
// 装饰类 多层
// 抽象基类
abstract class IComponent
{
	protected $site;
	abstract public function getSite();
	abstract public function getPrice();
}
// 抽象继承抽象 实现了部分方法
abstract class Decorator extends IComponent
{
	//Inherits both getSite() and getPrice()
	//This is still an abstract class and there's
	//no need to implement either method here
	//Job is to maintain reference to Component
	//public function getSite() { }
	//public function getPrice() { }
}

class BasicSite extends IComponent
{
	public function __construct()
	{
		$this->site="Basic Site";
	}

	public function getSite()
	{
		return $this->site;
	}
	public function getPrice()
	{
		return 1200;
	}
}

class DataBase extends Decorator{
	public function __costruct(IComponent $siteNow){
		$this->site = $siteNow;
	}
	public function getSite(){
		$fmat="<br/>&nbsp;&nbsp; MySQL Database ";
		return $this->site->getSite() . $fmat;
	}
	public function getPrice(){
		return 800 + $this->site->getPrice();
	}
}
class Video extends IComponent{
	public function __construct(IComponent $siteNow){
		$this->site = $siteNow;
	}
	public function getSite(){
		$fmat="<br/>&nbsp;&nbsp; Video ";
		return $this->site->getSite() . $fmat;
	}
	public function getPrice(){
		return 350 + $this->site->getPrice();
	}
}

class Client
{
	private $basicSite;

	public function __construct()
	{
		$this->basicSite=new BasicSite();
		$this->basicSite=$this->wrapComponent($this->basicSite);

		$siteShow=$this->basicSite->getSite();
		$format="<br/>&nbsp;&nbsp;<strong>Total= $";
		$price=$this->basicSite->getPrice();

		echo  $siteShow . $format . $price . "</strong><p/>";
	}

	private function wrapComponent(IComponent $component)
	{
		$component=new Maintenance($component);
		$component=new Video($component);
		$component=new DataBase($component);
		return $component;
	}
}
$worker=new Client()
?>
