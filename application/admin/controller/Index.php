<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
class Index  extends  AdminBase
{
    public function index()
    {

       return $this->fetch();
    }



}
