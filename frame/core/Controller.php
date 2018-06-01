<?php
namespace core;

class Controller{

//    定义默认跳转的属性
    protected $url = 'location.href = window.history.back()';

//    操作成功或者失败的跳转方法
    public function redirect($url = ''){
//        判定如果用户传递了url参数
        if ($url != ''){
//            将用户传递了url参数赋给属性
            $this -> url = "location.href = '".$url."'";
        }
        return $this;

    }

//    操作成功或者失败的提示方法
    public function message($msg){

//        引入页面实现跳转
        include 'public/view/message.php';

    }

}


?>