<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Db;
use think\Request;
class Register extends  AdminBase
{
    public function index()
    {
        //查询所有的数据分页
        $lists = Db::table('index_register')->order('id DESC')->paginate(15);
        $page  = $lists->render(); //页码数
        $this->assign('register', $lists);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    //删除
    public function del()
    {
        $id   = $this->request->param('id');
        $info = Db::table("index_register")
                 ->where("id", "=", $id)
                 ->delete();
        if ($info) {
            $this->success("删除成功！");
        } else {
            $this->success("删除失败！");
        }
    }

 

}