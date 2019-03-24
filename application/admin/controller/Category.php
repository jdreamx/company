<?php
namespace app\admin\controller;
use app\common\controller\Base;
use app\common\model\Cate as CateModel;
use think\facade\Request;


class Category extends Base
{
    protected $beforeActionList = ['isLogin'];

    public function index()
    {
        $cates = CateModel::all(function ($query){
            $query->order('cate_id', 'asc');
        });
        $this->view->cates = $cates;
        return $this->fetch();
    }
    //渲染增加分类的页面
    public function cateAdd()
    {
        return $this->fetch();
    }
    //添加分类
    public function doAdd()
    {
        //接受数据
        $data['cate_name'] = trim(input('post.cate_name'));
        $data['cate_order'] = (int)trim(input('post.cate_order'));
        $data['cate_type'] = (int)trim(input('post.cate_type'));
//        $data = Request::param();
        //判断分类是否已经存在
        if(CateModel::where(['cate_name'=>$data['cate_name']])->find()){
            exit(json_encode(['status'=>1]));
        }
        //保存数据
        $res = CateModel::create($data);
        if($res){
            exit(json_encode(['status'=>0, 'msg'=>'添加成功']));
        }
        exit(json_encode(['status'=>1]));
    }
    //渲染编辑页面
    public function cateEdit()
    {
        //接受编辑的id
        $id = Request::param('cateId');
        $cate = CateModel::get($id);
        $this->view->cate = $cate;
        return $this->fetch();
    }
    //保存编辑数据
    public function doEdit()
    {
        //接收数据
        $data = Request::param();
        //保存数据
        $res = CateModel::where(['cate_id'=>$data['cate_id']])->update($data);
        if($res){
            exit(json_encode(['status'=>0, 'msg'=>'添加成功']));
        }
        exit(json_encode(['status'=>1]));
    }
    //删除分类
    public function delete()
    {
        $id = input('get.cate_id');
        $res = CateModel::destroy($id);
        if($res){
            exit(json_encode(['status'=>0]));
        }
        exit(json_encode(['status'=>1]));
    }
}