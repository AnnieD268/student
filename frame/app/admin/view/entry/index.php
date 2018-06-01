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
<?php include 'public/view/header.php'?>
<div class="container">
    <div class="row">
        <?php
        include 'public/view/left.php'
        ?>
        <div class="col-lg-9">
            <div class="jumbotron">
                <div class="container">
                    <h1 style="font-size:45px">Hello, you are my bestfriends!</h1>
                    <p>HouDunWang always around you...</p>
                    <p>
                        <a href="" class="btn btn-primary btn-lg">Homepage</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php include 'public/view/footer.php'?>
</body>
</html>