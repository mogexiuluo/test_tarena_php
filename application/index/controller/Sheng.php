<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Db;
use think\Request;
use think\Session;
class Sheng extends IndexBase
{
    public function article()
    {
    	    $id = $this->request->param('id');
			$info = Db::table('index_shengda')->where('id','=',$id)->find();
			$this->assign("info",$info);
			
		return $this->fetch();
    }

  

}
