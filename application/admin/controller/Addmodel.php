<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Config;
use app\admin\model\Goods as Goodsmodel;
use app\admin\model\Brand as Brandmodel;
use app\admin\model\Goods_type as GTmodel;
class Addmodel extends \think\Controller{
     public function addmodel(){
         $model=new GTmodel;
         $request = Request::instance();
         $name=$request->post("type_name");
         if ($name!='') {
             $array = [
                 "type_name" => $name
             ];
             $add=$model->insert($array);
             $this->success("提交成功,正在跳转", "Modellist/modellist");
         }
         else{
             echo "<div class=\"response-msg error ui-corner-all\">
									<span>提交失败</span>
									请重新填写信息，商品信息必须完整。
								</div>";
         }
        return $this->fetch('typemodel/addmodel');
     }
    public function addmodel1(){
        return $this->fetch("typemodel/addmodel");
    }
}