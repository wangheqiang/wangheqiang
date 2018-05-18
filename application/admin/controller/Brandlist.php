<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Config;
use app\admin\model\Goods as Goodsmodel;
use app\admin\model\Brand as Brandmodel;
class Brandlist extends \think\Controller{
    public function brandlist(){
        $model=new Brandmodel;
        $select=$model->select();
        $this->assign('brand',$select);
        return $this->fetch('brand/brandlist');
    }
    public function brandlist1(){
        $model=new Brandmodel;
        $request = Request::instance();
        $search=$request->post('search');
        if ($search!='')
        {
            $select= Db::table("tb_brand")->where("brand_name","like","%$search%")->select();
            $this->assign('brand',$select);
            return $this->fetch('brand/brandlist');
        }
        else{
            $select=$model->select();
            $this->assign('brand',$select);
            return $this->fetch('brand/brandlist');
        }
    }
    public function delbrand(){
        $model=new Brandmodel;
        $request = Request::instance();
        $brand_id=$request->get('id');
        $del=$model->where(['brand_id'=>$brand_id])->delete();
        $this->redirect('brandlist/brandlist');
    }
}