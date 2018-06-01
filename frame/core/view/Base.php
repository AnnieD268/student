<?php
namespace core\view;

class Base{
//    定义模板文件路径属性
    protected $file;

//    定义模板变量属性
    protected $vars = [];

    public function make(){
//        组合需要加载的模板路径
        $this -> file = 'app/'.MODULE.'/view/'.strtolower(CONTROLLER).'/'.ACTION.'.php';
//        返回当前对象,为了后面可以自动触发__toString方法
        return $this;
    }

    public function with($name,$value){
//        调用with方法并将数据存入当前属性$vars中,用$name当成键名,$value当成键值
        $this -> vars[$name] = $value;
//        返回当前
        return $this;
    }

    public function __toString()
    {
//        提取当前模板变量
        extract($this -> vars);
//        加载对应模板
        include $this -> file;
//        当前魔术方法必须返回字符串,在这里没有什么要返回的,所以返回空字符串
        return '';
    }

}

?>