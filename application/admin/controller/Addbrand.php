<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Config;
use app\admin\model\Goods as Goodsmodel;
use app\admin\model\Brand as Brandmodel;
class Addbrand extends \think\Controller{
    public function addbrand()
    {
        $model = new Brandmodel;
        $request = Request::instance();
        $brand_name = $request->post("brand_name");
        $brand_url = $request->post('brand_url');
        $brand_type2 = $request->post("brand_type2");
        $brand_enviden = $request->post("brand_enviden");
        $brand_disc = $request->post("brand_disc");
        $file = request()->file('brand_logo');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $info1 = $info->getSaveName();
                //  $this->assign('file',$info1);
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        if ($brand_name != '') {
            $insarr = [
                'brand_name' => $brand_name,
                'brand_url' => $brand_url,
                'brand_type' => $brand_type2,
                'brand_enviden' => $brand_enviden,
                'brand_disc' => $brand_disc,
                'brand_logo' => $info1
            ];
            $add = $model->insert($insarr);
            echo "<div class=\"response-msg success ui-corner-all\">
									<span>提交成功</span>
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit
								</div>";
        }
        else{
            echo "<div class=\"response-msg error ui-corner-all\">
									<span>提交失败</span>
									请重新填写信息，商品信息必须完整。
								</div>";
        }
        return $this->fetch('brand/addbrand');
    }
    public function addbrand1(){
        return $this->fetch('brand/addbrand');
    }
}