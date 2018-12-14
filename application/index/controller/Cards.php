<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Db;
use think\Request;
use think\Captcha;
use think\Session;
class Cards extends IndexBase
{
	//详情页
	public function article(){
		    $id = $this->request->param('id');
			$info = Db::table('index_cards')->where('id','=',$id)->find();
			$this->assign("info",$info);
			
		return $this->fetch();
	}
	// 列表页
public function cards(){
		    	// 盛大游戏
    	$cards = Db::table('index_shengda')->select();
		$this->assign('cards',$cards);
		return $this->fetch();
	}
	
}