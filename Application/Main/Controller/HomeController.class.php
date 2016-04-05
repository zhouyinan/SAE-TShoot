<?php
namespace Main\Controller;
use Think\Controller;
class HomeController extends Controller{
  public function index(){
    $this->assign('title','欢迎使用SAE故障诊断工具');
    $this->assign('subtitle','输入您的二级域名以开始');
    if(!IS_POST){
      $this->display();
      return;
    }
    $appname = strtolower(I('post.appname'));
    if(preg_match("/^[a-z]{1}[a-z0-9]{3,32}$/",$appname) == 0){
      $this->assign(errmsg,'二级域名格式错误');
      $this->display();
      return;
    }
    session('appname',$appname);
    $this->redirect('select_problem_type',null,0,'redirecting...');
  }

  public function _before_select_problem_type(){
    $this->check_login();
  }
  public function select_problem_type(){
    $this->assign('title','欢迎使用SAE故障诊断工具');
    $this->assign('subtitle','请选择问题类型');
    $this->display();
  }

  public function _before_is_login(){
    //禁止方法被访客直接调用调用
    http_response_code(404);
    exit();
  }
  //检查用户是否已输入二级域名
  public function is_login(){
    return session('?appname');
  }

  public function _before_check_login(){
    //禁止方法被访客直接调用调用
    http_response_code(404);
    exit();
  }
  public function check_login(){
    if(!$this->is_login()){
      $this->redirect('Main/Home/index',null,0,'redirecting...');
      exit();
    }
  }
}
