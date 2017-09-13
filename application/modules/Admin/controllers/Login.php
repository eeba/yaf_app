<?php

class Controller_Login extends Common\AdminAbstract {
    protected $route = 'simple';
    public function indexAction(){
        
    }

    public function chinkAction(){
        $email = $this->getParams('email');
        $password = $this->getParams('password');
        $app_info = (new \Data\Novel\AppBase())->getInfoByEmail($email);
        if(!$app_info){
            throw new Exception('账号不存在', 5000004);
        }else{
            $ret = (new \Data\Novel\AppBase())->checkPass($password,$app_info['password']);
            if(!$ret){
                throw new Exception('密码错误', 5000005);
            }
        }
        $_SESSION['app_info'] = $app_info;
    }

    public function logoutAction(){
        $_SESSION = [];
        $this->redirect('/admin/login/index');
    }

    public function repasswordAction(){

    }

    public function dorepasswordAction(){
        $app_info = $_SESSION['app_info'];
        $password = $this->getParams('password');
        $new_password = $this->getParams('new_password');
        if(!$app_info){
            throw new Exception('系统异常', 5000004);
        }else{
            $ret = (new \Data\Novel\AppBase())->checkPass($password,$app_info['password']);
            if(!$ret){
                throw new Exception('原密码错误', 5000005);
            }
        }
        (new \Data\Novel\AppBase())->updateById($app_info['id'],['password'=>$new_password]);
    }
}
