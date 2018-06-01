<nav class="navbar navbar-inverse" style="border-radius: 0">
    <div class="container">
        <a class="navbar-brand" href="">Student Manager</a>
        <ul class="nav navbar-nav" style="float: right;">
            <li class="active">
                <a href="">homepage</a>
            </li>
            <li>
                <?php
                if (isset($_SESSION['username'])) {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="javascript:;"><?php echo $_SESSION['username'] ?></a></li>
                        <li><a href="index.php?s=admin/login/logout">退出</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="">注册</a></li>
                        <li><a href="index.php?s=admin/login/loginForm">登录</a></li>
                    </ul>
                    <?php
                }
                ?>
                <!--                    <a href="">登录</a>-->
            </li>
        </ul>
    </div>
</nav>