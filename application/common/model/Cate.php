<?php
namespace app\common\model;
use think\Model;

class Cate extends Model
{
    //配置模型绑定的数据表
    protected $table = 'category';
    //配置数据表的主键
    protected $pk = 'cate_id';

}