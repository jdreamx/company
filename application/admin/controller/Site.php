<?php
namespace app\admin\controller;
use app\common\controller\Base;
use app\common\model\Site as SiteModel;

class Site extends Base
{
    protected $beforeActionList = ['isLogin'];

    public function index()
    {
        return $this->fetch();
    }
    //渲染站点编辑页面
    public function edit()
    {
        return $this->fetch();
    }
    //保存站点编辑信息
    public function doEdit()
    {
        //接受 提交的数据
        $data['site_name'] = trim(input('post.site_name'));
        $data['keywords'] = trim(input('post.keywords'));
        $data['desc'] = trim(input('post.desc'));
        $data['update_time'] = time();
        //更新数据
        SiteModel::where(['site_id'=>1])->update($data);
    }
}