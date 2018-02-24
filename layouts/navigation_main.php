<nav class="navbar navbar-inverse navbar-static-top">
    <div class="navbar-header">
        <a class="navbar-toggle" data-toggle="collapse" data-target="#site_nav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a class="navbar-brand" href="./">                        
            <?php echo SITE_TITLE; ?>
        </a>
    </div>
    <div id="site_nav" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <?php
            include 'navigation_base.php';
            if (!$session->is_logged_in()):
                ?>
                <li class="navbar-right">
                    <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>            
                </li>
                <?php
            else:
                $user = $session->get_user_object();
                include 'navigation_user.php';
                if ($user->type == 'admin') {
                    include 'navigation_admin.php';
                }
                ?>
            <?php endif; ?>
        </ul>
    </div>
</nav>
