<?php

namespace app\index\controller;

use app\common\model\Article as ArtModel;
use app\common\controller\Base;
use think\facade\Request;

/**
 * 处理首页的文章
 * Class Article
 * @package app\index\controller
 */
class Article extends Base
{
    /**
     * 编辑思路
     * 1.页面类型有两类， 列表页，详情页
     * 2.对应两个模板，art_list.html  art_content.html
     * 3. 存在art_id 获取列表中的一个文章内容， 调用详情页模板，
     *      没有文章id，就获取记录，调用列表页模板
     * 判断cate_id
     */
    public function getRes()
    {
        //获取最新的文章
        $latest_art = ArtModel::field(['art_title','create_time','art_id','cate_id'])->order('create_time','desc')->limit(10)->select();
        $this->view->latest_art = $latest_art;  //模板赋值

        //获取提交的 分类id
        $cate_id = $this->request->param( 'cate_id' );
        //把分类名称 作为页面标题  赋值模板
        $this->view->title = getCateName( $cate_id );

        //根据分类id，获取分类的类型 0 单页面， 1列表页
        $type = getCateType( $cate_id );

        switch ( $type ) {
            case 0: //详情页  该分类就是一个详情页
                //获取详情页内容
                $art = ArtModel::where( 'cate_id', $cate_id )->field(['art_title','art_content'])->find();
                //将内容 赋值 给模板变量
                $this->view->art = $art;
                //调用 详情页模板
                return $this->view->fetch( 'art_content' );
                break;

            case 1:
                //判断是否存在 文章art_id
                $art_id = Request::param( 'art_id' );
                if ( $art_id ) {
                    //获取文章内容
                    $art = ArtModel::where( 'art_id', $art_id )->field(['art_title','art_content'])->find();
                    //内容 赋值 模板变量
                    $this->view->art = $art;
                    //调用详情页模板
                    return $this->view->fetch( 'art_content' );
                    break;
                }

                //获取 列表记录  paginate() 分页数据
                $art_list = ArtModel::where( 'cate_id', $cate_id )->order( 'create_time', 'desc' )->paginate( 8 );
                //创建分页变量
                $page = $art_list->render();
                //分类变量 默认会在地址扩展名后面添加?page=*, 会自动删掉分类id，需要修改地址
                $page = str_ireplace('page','cate_id='.$cate_id.'&page',$page);

                // 列表记录 模板赋值
                $this->view->art_list = $art_list;
                //分页变量 模板赋值
                $this->view->page = $page;
                //调用模板
                return $this->view->fetch( 'art_list' );
                break;
        }
    }
}