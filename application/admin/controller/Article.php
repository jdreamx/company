<?php
namespace app\admin\controller;
use app\common\controller\Base;
use app\common\model\Article as ArticleModel;
use think\facade\Request;

class Article extends Base
{
    protected $beforeActionList = ['isLogin'];

    public function index()
    {
        $arts = ArticleModel::where(['delete_time'=>0])->order('art_id','desc')->paginate(8);
//        exit(dump($arts));
        $this->view->arts = $arts;
        return $this->fetch();
    }

    //渲染编辑页面
    public function artEdit()
    {
        //接受文章id参数
        $id = input('get.art_id');
        //获取文章记录
        $data = ArticleModel::get($id);

        $this->view->art = $data;
        return $this->fetch();
    }

    //保存编辑后的数据
    public function doEdit()
    {
        //接收编辑后的数据
        $data = Request::param();
        $data['update_time'] = time();
//        exit(dump($data));
        $res = ArticleModel::where(['art_id'=>$data['art_id']])->update($data);
        if($res){
            exit(json_encode(['status'=>0, 'msg'=>'保存成功']));
        }
        exit(json_encode(['status'=>1]));
    }
    //删除单条记录
    public function del()
    {
        //接收要删除的id
        $id = (int)Request::param('art_id');
        $delete_time = time();
        $res = ArticleModel::where(['art_id'=>$id])->update(['delete_time'=>$delete_time]);
        if($res){
            exit(json_encode(['status'=>0, 'msg'=>'删除成功']));
        }
        exit(json_encode(['status'=>1]));
    }
    //渲染 文档添加页面
    public function artAdd()
    {
        return $this->fetch();
    }
    //保存 新增文档
    public function doAdd()
    {
        $data = Request::param();
        $data['create_time'] = $data['update_time'] = time();
        $res = ArticleModel::create($data);
        if($res){
            exit(json_encode(['status'=>0, 'msg'=>'保存成功']));
        }
        exit(json_encode(['status'=>1]));
    }
    //批量删除
    public function delAll()
    {
        //接收要删除的id
        $ids = json_decode(input('get.id_list'));
        $res = ArticleModel::where(['art_id'=>$ids])->update(['delete_time'=>time()]);
        if($res){
            exit(json_encode(['status'=>0, 'msg'=>'删除成功']));
        }
    }
}