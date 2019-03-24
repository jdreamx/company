<?php
namespace app\admin\controller;
use app\common\controller\Base;
use app\common\model\Article;

class Trash extends Base
{
    public function index()
    {
        $this->view->arts = Article::where('delete_time', '>', 0)->paginate(8);
        return $this->fetch();
    }

    //恢复记录
    public function restore()
    {
        //获取要恢复的id
        $id = input('get.art_id');
        $res = Article::update(['delete_time' => 0], ['art_id' => $id]);
        if ($res) {
            exit(json_encode(['status' => 0, 'msg' => '恢复成功']));
        }
        exit(json_encode(['status' => 1]));
    }

    //批量恢复
    public function resAll()
    {
        //接受要恢复的id组
        $id_list = json_decode(input('get.id_list'));
        $res = Article::update(['delete_time' => 0], ['art_id' => $id_list]);
        if ($res) {
            exit(json_encode(['status' => 0, 'msg' => '恢复成功']));
        }
        exit(json_encode(['status' => 1]));
    }
    //单条真实删除
    public function delTrue()
    {
        //获取要删除的id
        $id = input('get.art_id');
        $res = Article::destroy($id);
        if ($res) {
            exit(json_encode(['status' => 0, 'msg' => '删除成功']));
        }
        exit(json_encode(['status' => 1]));
    }

    //批量真实删除
    public function delTrueAll()
    {
        //接受要删除的id组
        $id_list = json_decode(input('get.id_list'));
        $res = Article::destroy($id_list);
        if ($res) {
            exit(json_encode(['status' => 0, 'msg' => '删除成功']));
        }
        exit(json_encode(['status' => 1]));
    }

}