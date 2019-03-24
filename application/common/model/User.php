<?php
namespace app\common\model;
use think\Model;

class User extends Model
{
    //配置模型绑定的数据表
    protected $table = 'user';
    //配置数据表的主键
    protected $pk = 'user_id';
    //开启自动时间戳
    protected $autoWriteTimestamp = true;
    //开启自动更新的字段名称
    protected $update_time = 'update_time';
    //时间戳格式化
    protected $dateFormat = 'Y-m-d H:i:s';
    //设置器 密码 使用sha()1 后再写入
    public function setPasswordAttr($password)
    {
        return sha1($password);
    }
}