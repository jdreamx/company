<?php

namespace app\admin\controller;

use app\common\controller\Base;

/**
 * 后台入口类
 * Class Index
 * @package app\admin\controller
 */
class Index extends Base
{
    //前置操作：判断是否登录了
    protected $beforeActionList = [ 'isLogin' ];

    //渲染后台首页
    public function index()
    {
        return $this->fetch( 'index' );
    }

    //渲染 后台首页中的 欢迎页面（展示系统参数）
    public function welcome()
    {
        return $this->fetch( 'welcome' );
    }
}