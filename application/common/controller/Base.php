<?php
namespace app\common\controller;
use app\common\model\Cate;
use think\Controller;
use app\common\model\Site;
use think\facade\Session;

/**
 * 在公共的控制器定义站点信息和登录检测
 */
class Base extends Controller
{
    protected $site = null;//存放站点信息
    //初始化操作
    public function initialize()
    {
        //获取站点信息
        $this->site = Site::get(1);
        //把站点信息赋值到模板
        $this->view->site = $this->site;
        //获取分类并赋值到模板中
        $this->view->cates = Cate::order('cate_order', 'asc')->select();
//        $this->isLogin();
    }
    //判断用户是否登录
    public function isLogin()
    {
        //没登录 跳转登录界面
        if(!Session::has('user_name'))
        {
            $this->redirect('user/login');
        }
    }
    //判断用户是否已经登录
    protected function isLogined()
    {
        if(Session::has('user_name'))
        {
            $this->error('请不要重复登录');
        }
    }
}