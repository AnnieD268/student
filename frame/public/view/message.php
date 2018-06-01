<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>消息提示</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="background: #eee;">
<div class="jumbotron" style="text-align: center;margin-top:100px;">
    <h1><?php echo $msg; ?></h1>
    <p>...</p>
    <p><a class="btn btn-primary btn-lg" href="index.php?s=admin/login/loginForm" role="button">如果跳转失败，请点击这里</a></p>
</div>
<script>
    setTimeout(function () {
        <?php echo $this->url; ?>
    },2000)
</script>
</body>
</html>