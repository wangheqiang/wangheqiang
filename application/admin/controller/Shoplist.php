<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use app\admin\model\Goods as Goodsmodel;
class Shoplist extends \think\Controller{
    /**
     * @return mixed
     * 显示商品列表
     */
    public function shoplist1(){
        $model=new Goodsmodel;
        $request = Request::instance();
        $type1=$request->post("goods_type1");
        $type2=$request->post("goods_brand");
        $search=$request->post("search");
        if ($search!='')
        {
//            $select= Db::query("select * from tb_goods where `goods_name` like '%$search%' or `goods_code` like '%$search%'");
            $select=Db::table("tb_goods")->where('goods_name',"like","%$search%")->select();
            $this->assign('goods',$select);
            return $this->fetch('shop/shoplist');
        }
        if($type1=='1'&&$type2=='1')
        {
            $select=$model->select();
            //  $select = Db::query("select * from tb_article order by art_id DESC "); //直接查询全部商品
            $this->assign('goods',$select);
            return $this->fetch('shop/shoplist');
        }
       else if($type1=='1')
        {
            $select=$model->where(['goods_brand'=>$type2])->select();
            $this->assign('goods',$select);
            return $this->fetch('shop/shoplist');
        }
        else if ($type2=='1')
        {
            $select=$model->where(['goods_type'=>$type1])->select();
            $this->assign('goods',$select);
            return $this->fetch('shop/shoplist');
        }
        else{
            $select=$model->where(['goods_type'=>$type1,'goods_brand'=>$type2])->select();
            //  $select = Db::query("select * from tb_article where art_jurisdiction='$fulei1'and art_examine='$fulei2'");//两种同时查询
            $this->assign('goods',$select);
            return $this->fetch('shop/shoplist');
        }

    }
    public function shoplist(){
        $model=new Goodsmodel;
        $select=$model->select();
        $this->assign('goods',$select);
        return $this->fetch('shop/shoplist');
    }
    /**
     * 删除商品
     */
    public function delgoods(){
        $model=new Goodsmodel;
        $request = Request::instance();
        $goods_id=$request->get('id');
        $del=$model->where(['goods_id'=>$goods_id])->delete();
        $this->redirect('Shoplist/shoplist');
    }

    /**
     * 修改商品
     */
    public function updategoods(){
        $model=new Goodsmodel;
        $request = Request::instance();
        $goods_id=$request->get('id');
        $select=$model->where(['goods_id'=>$goods_id])->select();
        $this->assign('goods',$select);
        //修改
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
        $file = request()->file('site_logo');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $info1= $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
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
                'goods_thumbnail' => $info1,
                'goods_stock' => $stock,
                'goods_keyword' => $keyword,
                'goods_contents' => $contents,
            ];
            $update = $model->where(['goods_id' => $goods_id])->update($insarr);
            echo "<div class=\"response-msg success ui-corner-all\">
									<span>提交成功</span>
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit
								</div>";
        }
        return $this->fetch('shop/update');
    }
}