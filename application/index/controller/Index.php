<?php
namespace app\index\controller;
use \think\Controller;
class Index extends \think\Controller{
    public function index (){
        return $this->fetch('utf8-php/dialogs/image/image');
    }
}