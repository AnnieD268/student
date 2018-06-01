<?php
//引入composer提供的autoload.php自动加载文件
include 'vendor/autoload.php';

//实例化对象并调用里面的run方法
(new \core\Boot()) -> run();

?>