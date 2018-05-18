<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Config;
use app\admin\model\Goods_type as GTmodel;
class Modellist extends \think\Controller{
    public function modellist(){
       $model=new GTmodel;
       $select=$model->select();
       $this->assign("type",$select);
        return $this->fetch("typemodel/modellist");
    }
}