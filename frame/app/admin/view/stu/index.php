<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php include 'public/view/header.php' ?>
<div class="container">
    <div class="row">
        <?php include 'public/view/left.php' ?>
        <div class="col-lg-9">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="index.php?s=admin/stu/index">stu list</a></li>
                <li><a href="index.php?s=admin/stu/create">add stu</a></li>
            </ul>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>年龄</th>
                    <th>手机</th>
                    <th>班级</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($stu as $k => $v){ ?>
                    <tr>
                        <td><?php echo $k + 1; ?></td>
                        <td><?php echo $v['name']; ?></td>
                        <td><?php echo $v['sex']; ?></td>
                        <td><?php echo $v['age']; ?></td>
                        <td><?php echo $v['cellphone']; ?></td>
                        <td><?php echo $v['gname']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="index.php?s=admin/stu/edit&id=<?php echo $v['id']; ?>" class="btn btn-primary">编辑</a>
                                <a href="javascript:;" onclick="del(<?php echo $v['id']; ?>)"
                                   class="btn btn-danger">删除</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // function del(id) {
        //     if (confirm('确定删除该班级数据吗？')){
        //
        //         location.href = 'index.php?s=admin/grade/delete&id=' + id;
        //
        //     }
        // }

        function del(id) {
            if (confirm('确定删除该学生列表数据吗?')) {
                //如果确定要删除,发送ajax
                $.ajax({
                    url:'index.php?s=admin/stu/ajaxDelete&id=' + id,
                    type:'get', //如果请求方式是post,就需要data属性,如果是get可以不要
                    dataType:'json', //定义返回数据类型
                    success:function (phpData) {
                        alert(phpData.message);
                        if (phpData.valid){
                            //刷新当前页面
                            window.location.reload();
                        }
                    }

                })
            }
        }
    </script>
    <?php include 'public/view/footer.php' ?>
</body>
</html>