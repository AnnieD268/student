<?php
$config = [
    'host' => 'localhost',
    'dbname' => 'article',
    'username' => 'root',
    'password' => 'root',
];

//当前文件是优先加载的
//调用静态方法
//\core\model\Model::getConfig($config);

//调用非静态方法
(new \core\model\Model()) -> getConfig($config);

?>