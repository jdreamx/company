<?php
namespace app\common\model;
use think\Model;

class Article extends Model
{
    //模型绑定的数据表
    protected $table = 'article';
    //数据表的主键
    protected $pk = 'art_id';
    //开启自动时间戳
    protected $autoWriteTimestamp = true;
    //开启自动更新的字段名称
    protected $update_time = 'update_time';
    //时间戳格式化
    protected $dateFormat = 'Y-m-d H:i';
}