<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use app\common\model\User as UserModel;
use think\facade\Session;

class User extends Base
{
    //前置操作
    protected $beforeActionList = ['isLogin'=>['except'=>'login,doLogin']];
    //渲染管理员列表
    public function index()
    {
        $user = UserModel::get(1);
        $this->view->user = $user;
        return $this->fetch();
    }
    public function login()
    {
        $this->islogined();
        return $this->view->fetch();
    }
    //处理登录验证
    public function doLogin()
    {
        //接收登录数据
        $email = trim(input('post.email'));
        $password = sha1(trim(input('post.password')));
        $user = UserModel::where(['email'=>$email])->find();
        if(!$user){
            exit(json_encode(['status'=>1, 'msg'=>'用户不存在']));
        }
        $res = UserModel::where(['email'=>$email,'password'=>$password])->find();
        if(!$res){
            exit(json_encode(['status'=>1, 'msg'=>'密码错误']));
        }
        Session::set('user_name', $user['user_name']);
        exit(json_encode(['status'=>0, 'msg'=>'登录成功']));

    }
    //退出登录
    public function logout()
    {
        Session::delete('user_name');
        $this->redirect('user/login');
    }

    //渲染用户编辑页面
    public function adminEdit()
    {
        $user = UserModel::get(1);
        $this->view->user = $user;
        return $this->fetch();
    }
    //处理用户编辑
    public function doEdit()
    {
        $data['email'] = trim(input('post.email'));
        $data['password'] = trim(input('post.password'));
        $data['update_time'] = time();
        UserModel::where(['user_id'=>1])->update($data);
    }
}