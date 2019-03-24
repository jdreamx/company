<?php
namespace app\common\model;
use think\Model;

class Site extends Model
{
    //模型绑定的数据表
    protected $table = 'site';
    //数据表的主键
    protected $pk = 'site_id';
    //开启自动时间戳
    protected $autoWriteTimestamp = true;

}