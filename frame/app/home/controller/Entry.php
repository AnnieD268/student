<?php
namespace app\home\controller;

use core\Controller;
use core\view\View;
use system\model\Stu;
use system\model\Grade;

class Entry extends Controller{

    public function index(){
////        获取所有班级数据并分配
//        $grade = Grade::get() -> toArray();
////        获取所有的学生数据
//        $stu = Stu::get() -> toArray();
//        定义sql语句
//        因为需要展示班级名称，所以单独获取学生列表数据不够，需要组合一对多的sql语句
        $sql = 'select stu.*,grade.gname from stu join grade on stu.gid = grade.id';
//        调用框架提供的query方法，执行sql语句
        $stu = Stu::query($sql) -> toArray();
//        加载模板，分配变量
        return View::make() -> with('stu',$stu);
    }

    public function show(){
//        获取所有班级数据并分配
        $grade = Grade::get() -> toArray();
//        获取要查看的学生id
        $id = $_GET['id'];
//        获取单条数据
        $stu = Stu::find($id) -> toArray();
//        加载模板，分配变量
        return View::make() -> with('stu',$stu) -> with('grade',$grade);
    }

}



?>