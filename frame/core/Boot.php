<?php
namespace core;

class Boot{

    public function run(){
//        开启session
        session_start();
//        分析get参数，如果有get参数s,就分析s参数得到的模块、控制器和方法，如果没有s，就给默认值
        if (isset($_GET['s'])){
//            如果存在s参数
//            切割数组
            $info = explode('/',$_GET['s']);
//            定义模块变量
            $m = $info[0];
//            定义控制器变量
            $c = ucfirst($info[1]);
//            定义方法变量
            $a = $info[2];
        }else{
//            如果没有s参数
//            定义模块变量
            $m = 'home';
//            定义控制器变量
            $c = 'Entry';
//            定义方法变量
            $a = 'index';
        }

//        定义模块常量
        define('MODULE',$m);
//        定义控制器常量
        define('CONTROLLER',$c);
//        定义方法常量
        define('ACTION',$a);
//        组合需要调用的类名称
        $class = '\app\\'.$m.'\\controller\\'.$c;
//        使用回调函数调用对应类方法
        echo call_user_func_array([new $class,$a],[]);
    }

}


?>