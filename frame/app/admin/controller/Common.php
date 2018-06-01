<?php
namespace app\admin\controller;

use core\Controller;

class Common extends Controller{

    public function __construct()
    {
//        判断用户是否登录
//        如果不存在session中的username，则代表用户没有登录，跳转去登录页面
        if (!isset($_SESSION['username'])){

//            在构造函数中,return没有用,所以这里需要用die
            die($this -> redirect('index.php?s=admin/login/loginForm') -> message('请先登录'));
        }
    }

}

?>