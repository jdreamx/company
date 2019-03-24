<?php
//全局的公共函数库
use think\Db;

//获取当前时间
function getCurrentTime()
{
    return date( 'Y-m-d H:i:s', time() );
}

//获取用户名
function getUserName()
{
    return Db::table( 'user' )->where( 'user_id', 1 )->value( 'user_name' );
}

//获取mysql版本
function getMysqlVersion()
{
    return Db::query( 'select version() as version' )[0]['version'];
}

//获取文章记录总数
function getRecNum()
{
    return Db::table( 'article' )->where( [ 'delete_time' => 0 ] )->count();
}

//获取文章的分类名称
function getCateName( $id )
{
    return Db::table( 'category' )->where( [ 'cate_id' => $id ] )->value( 'cate_name' );
}

//获取分类的类别
function getCateType( $id )
{
    return Db::table( 'category' )->where( [ 'cate_id' => $id ] )->value( 'cate_type' );
}

//获取回收站 总记录数
function getTrashNum()
{
    return Db::table( 'article' )->where( 'delete_time', '>', 0 )->count();
}
