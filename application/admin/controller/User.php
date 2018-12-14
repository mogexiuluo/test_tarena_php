<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use app\admin\model\AdminUser;
use think\Db;
use think\Request;
class User  extends  AdminBase
{
    public function index()
    {
        //查询所有用户
        $user = AdminUser::all();
        foreach($user as $val){
            $info = $val->toArray();
        }
        $this->assign("user",$user);
        return $this->fetch();
    }
   //添加管理员
    public  function  addmanger(){
          if($_POST){
              $username = $this ->request->param("user");
              $password =$this ->request->param("password");
              $data=[
                  "username"=>$username,
                  "password"=>md5($password)
              ];
               $res = Db::table("admin_user")->insert($data);
                 if($res){
                      $this->success("管理员添加成功！",'admin/user/index');
                 }else{
                     $this->error("管理员添加失败！");
                 }
          }
        return $this->fetch();
    }
    //删除用户
    public  function  del(){
           $id = $this->request->param("id");
            $res =Db::table("admin_user")
                     ->where("id",'=',$id)
                     ->delete();
             if($res){
                   $this->success("删除成功！");
             }else{
                 $this->error("删除失败！");
             }

    }
   //编辑用户
    public  function  editor(){
         $id = $this->request->param('id');
         $info =Db::table("admin_user")
                  ->where("id","=",$id)
                  ->find();
         $this->assign("info",$info);
           if($_POST){
               $id       =  $this->request->param('id');
               $username =  $this ->request->param("user");
               $password =  $this ->request->param("password");
               $data=[
                   "username"=>$username,
                   "password"=>md5($password)
               ];
               $res = Db::table("admin_user")
                        ->where("id","=",$id)
                        ->update($data);
               if($res){
                   $this->success("管理员修改成功！",'admin/user/index');
               }else{
                   $this->error("管理员修改失败！");
               }
           }




        return  $this->fetch();
    }


}