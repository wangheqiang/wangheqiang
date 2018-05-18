<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Config;
use app\admin\model\Goods as Goodsmodel;
class Addgoods extends \think\Controller{
    public function addgoods (){
        $model=new Goodsmodel;
        $request = Request::instance();
        $name=$request->post("goods_name");
        $alias_name=$request->post('goods_alias_name');
        $code=$request->post("goods_code");
        $type1=$request->post("goods_type1");
        $brand=$request->post("goods_brand");
        $supplier=$request->post("goods_supplier");
        $price=$request->post("goods_price");
        $market_price=$request->post("goods_market_price");
        $cost_price=$request->post("goods_cost_price");
        $stock=$request->post("goods_stock");
        $keyword=$request->post("goods_keyword");
        $contents=$request->post("goods_contents");
        $time=date("Y/m/d h:i:sa");
        $file = request()->file('site_logo');
        $video = request()->file('video');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $info1= $info->getSaveName();
              //  $this->assign('file',$info1);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        if($video){
            $videoinfo = $video->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($videoinfo){
                $videoinfo1= $videoinfo->getSaveName();
                //  $this->assign('file',$info1);
            }else{
                // 上传失败获取错误信息
                echo $video->getError();
            }
        }
        if ($name!='') {
            $insarr = [
                'goods_name' => $name,
                'goods_alias_name' => $alias_name,
                'goods_code' => $code,
                'goods_type' => $type1,
                'goods_brand' => $brand,
                'goods_supplier' => $supplier,
                'goods_price' => $price,
                'goods_market_price' => $market_price,
                'goods_cost_price' => $cost_price,
                'goods_thumbnail'=>$info1,
                'goods_video'=>$videoinfo1,
                'goods_stock' => $stock,
                'goods_keyword' => $keyword,
                'goods_contents' => $contents,
                'goods_info_time' => $time,
                'goods_state' => 1
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
        return $this->fetch('shop/addgoods');
    }
    public function ajax(){
        $image = request()->file('file_images');
        if($image){
            $info = $image->move(ROOT_PATH . 'public' . DS . 'uploads');
             echo $logo='/public'.DS.'uploads'.DS.$info->getSaveName();
        }
    }
    public function imglist(){
        return $this->fetch('shop/addgoods');
    }
}