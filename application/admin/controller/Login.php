<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \app\admin\model\Admin as Adminmodel;
class Login extends \think\Controller{
    public function login (){
        $model=new Adminmodel;
        $request = Request::instance();
        $usename = $request->post('usename');
        $pwd =  $request->post('password');
        //$pwd1=md5($pwd);
        $aa=$model->where([ 'admin_usename'=>$usename , 'admin_password'=>$pwd])->select(); //model层连接数据库方法
        if (!empty($aa)) {
//            Session::set("admin", $aa[0]['user_name']);
//            Session::set("admin_id", $aa[0]['user_id']);
            $this->success("登录成功", "Index/Index");
        }
        else {
            echo "<script>alert('账号或密码不正确，请重新输入')</script>";
        }
        return $this->fetch('login/login');
    }
    public function login1(){
        return $this->fetch('login/login');
    }
}