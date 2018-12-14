<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Db;
use think\Request;
use think\Captcha;
use think\Session;
class Index extends IndexBase
{
    public function index()
    {
    	// 盛大游戏
    	$sd = Db::table('index_shengda')->select();
		 // 搜狐游戏
    	$sh = Db::table('index_souhu')->select();
		 // 网易游戏
    	$wx = Db::table('index_wangyi')->select();
		
		$this->assign('sd',$sd);
		$this->assign('sh',$sh);	
		$this->assign('wx',$wx);
		
      return $this->fetch();
    }
    //注册页面
  public  function register(){return $this->fetch();} 
	// 登录页面	
	public function login(){return $this->fetch();}
	// 声明页面
	public function shengming(){return $this->fetch();}
    // 联系我们页面
	public function contact(){return $this->fetch();}
     // 充值卡页面
	public function  game(){
		$info = Db::table("index_chongzhi")->select();
		
		$this->assign("info",$info);
		return $this->fetch();}
	//详情页
		public function  article(){
            $id = $this->request->param('id');
			$info = Db::table('index_chongzhi')->where('id','=',$id)->find();
			$this->assign("info",$info);
			
		return $this->fetch();
		}
	
	

	//退出页面
	public function logout(){
		Session::clear();
		return $this->success("退出成功！",'index/index/index');
	}
	
  //注册插入数据
  public function save(){
  	$name            = $this->request->param('Username');
  	$Password        = $this->request->param('Password');
  	$ContactName     = $this->request->param('ContactName');
  	$ContactIDNumber = $this->request->param('ContactIDnumber');
  	$Telephone       = $this->request->param('Telephone');
  	$QQUin           = $this->request->param('QQUin');
  	$weixin          = $this->request->param('weixin');
  	$bankId          = $this->request->param('bankid');
	$captcha         = $this->request->param('captcha');
	 $data = [
	    "name"=>$name,
	    "Password"=>md5($Password),
	    "contactName"=>$ContactName,	    
	    "ContactIDNumber"=>$ContactIDNumber,
	    "Telephone"=>$Telephone,
	    "QQUin"=>$QQUin,
	    "weixin"=>$weixin,
	    "bankid"=>$bankId	
	 ];
	 if(captcha_check($captcha)){
	 	 if($name != ''){
   	  $res = Db::table('index_register')->insert($data);
	   if($res){
	   	  $this->success("注册成功！",'index/index/index');
	   } else {
	   	  $this->success("注册失败！",'index/index/register');
	   }
   }
	
	 }else{
	 	$this->success("验证码错误！",'index/index/register');
	 }
  
  }
  //登录方法
  public function doLogin(){
  	$name         = $this->request->param('UserName');
  	$Password     = $this->request->param('Password');
  	$captcha      = $this->request->param('Captcha');
//	var_dump(captcha_check($captcha));exit;
	if($name !=''){
		if(captcha_check($captcha)){
			$res = Db::table("index_register")
			        ->where([
			         'name'=>$name,
			         'Password'=>md5($Password)
			        ])
					->find();
					
			if($res){
				Session::set('id',$res['id']);
				Session::set('UserName',$res['contactName']);
				$this->success('登录成功！','index/index/index');
			} else{
				$this->success('登录失败！','index/index/login');
			}
		} else {
			$this->success('验证码错误！','index/index/login');
		}
	}
	
	
  }

  

}
