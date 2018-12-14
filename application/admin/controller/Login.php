<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Captcha;
class Login extends  Controller
{
    public function index()
    {
       return $this->fetch();
    }
    //登录接收信息
    public function dologin(){
    	   if($_POST){
              $username = $this ->request->param("user");
              $password = $this ->request->param("pwd");
              $captcha = $this ->request->param("captcha");
//            var_dump(captcha_check($captcha));exit;
              if(!captcha_check($captcha)){
                 $this->success("验证码错误！",'admin/login/index');
              } else{
              $data=[
                  "username" => $username,
                  "password" => md5($password)
              ];
               $res = Db::table("admin_user")->where($data)->find();

                 if($res){
                 	session("userid",$res['id']);
                 	session("user",$username);
                    return  $this->success("登录成功！",'admin/index/index');
                 }else{
                   return  $this->error("登录失败！");
                 }
              }


          }
          
    }
    // 退出
    public function loginOut(){
      Session::delete("userid");
      $this->success("退出成功！",url('admin/login/index'));
    }


}
