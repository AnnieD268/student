<?php
namespace app\admin\controller;

use core\view\View;
use system\model\Stu as s;
use system\model\Grade;

class Stu extends Common{

//    学生管理列表
    public function index(){
//        因为需要展示班级名称，所以单独获取学生列表数据不够，需要组合一对多的sql语句
        $sql = 'select stu.*,grade.gname from stu join grade on stu.gid = grade.id';
//        调用框架提供的query方法，执行sql语句
        $stu = s::query($sql) -> toArray();
//        加载学生列表模板
        return View::make() -> with('stu',$stu);
    }

//    加载添加学生模板方法
    public function create(){
//        获取所有班级数据
        $grade = Grade::get() -> toArray();
//        加载添加学生模板
        return View::make() -> with('grade',$grade);
    }

//    添加学生列表方法
    public function add(){
//        获取post数据
        $post = $_POST;
//        将post数据调用框架add方法，添加到stu表里
        $result = s::add($post);
//        判断结果是否为真，为真就是添加成功，为假就是添加失败
        if ($result){
            return $this -> redirect('index.php?s=admin/stu/index') -> message('添加成功');
        }else{
            return $this -> redirect() -> message('添加失败');
        }

    }

//    编辑学生列表方法
    public function edit(){
//        获取所有班级数据并分配
        $grade = Grade::get() -> toArray();
//        获取需要修改的学生id
        $id = $_GET['id'];
//        通过id找到对应学生表数据
        $stu = s::find($id) -> toArray();
//        如果有post数据
        if ($_POST){
//            获取post 数据
            $post = $_POST;
//            调用框架的edit方法来修改数据
            $result = s::edit($post);
//        判断结果是否为真，为真返回成功，为假返回失败
            if ($result){
                return $this -> redirect('index.php?s=admin/stu/index') -> message('编辑成功');
            }else{
                return $this -> redirect() -> message('编辑失败');
            }
        }
//        加载编辑学生模板，分配修改的数据
        return View::make() -> with('stu',$stu) -> with('grade',$grade);
    }

//    删除学生数据
    public function delete(){
//        获取所有班级数据并分配
        $grade = Grade::get() -> toArray();
//        获取需要删除的学生id
        $id = $_GET['id'];
//            调用框架的delete方法来修改数据
        $result = s::delete($id);

//        判断结果是否为真，为真返回成功，为假返回失败
        if ($result){
            return $this -> redirect('index.php?s=admin/stu/index') -> message('删除成功');
        }else{
            return $this -> redirect() -> message('删除失败');
        }


    }

    public function ajaxDelete(){
//        获取需要删除的学生列表id
        $id = $_GET['id'];
//        删除对应id
        $result = s::delete($id);
//        判断$result返回结果是否为真,来返回给前台不同的处理结果
        if ($result){
//            如果为真,代表删除成功
            return json_encode(['valid' => 1,'message' => '学生数据删除成功']);
        }else{
//            如果为假,代表删除失败
            return json_encode(['valid' => 0,'message' => '学生数据删除失败']);
        }
    }






}


?>