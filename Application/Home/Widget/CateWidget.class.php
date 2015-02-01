<?php
namespace Home\Widget;
use Think\Controller;
class CateWidget extends Controller {
    public function menuAction($id , $name){
        echo $id.':'.$name;
    }
}
