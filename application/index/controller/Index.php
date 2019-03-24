<?php

namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Cate;
use app\common\model\Article;
use think\facade\Request;

class Index extends Base
{
    public function index()
    {
        //页面标题
        //复制模板变量title
        $this->view->title = '首页';

        //新闻列表数据
        $this->view->news = Article::all( function ( $query ) {
            $query->where( 'cate_id', 2 )->order( 'create_time', 'desc' )->limit( 10 );
        } );
        //产品列表数据
        $this->view->products = Article::all( function ( $query ) {
            $query->where( 'cate_id', 3 )->order( 'create_time', 'desc' )->limit( 10 );
        } );

        return $this->fetch();
    }

    public function hello( $name = 'ThinkPHP5' )
    {
        return 'hello,' . $name;
    }
}
