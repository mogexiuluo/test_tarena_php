<?php

namespace app\common\controller;
use think\Controller;
use think\Session;
class AdminBase  extends  Controller
{
    public function _initialize()
    {
        //$id = Session::get("userid");
            if(!session("userid")){
               $this->error("非法登录，请联系管理员",url('admin/login/index'));
            }
    }
}