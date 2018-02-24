<?php
$nav_only = TRUE;
include './layouts/header.php';

if ($session->is_logged_in()) {
    redirect_to("index.php");
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = User::find_by_sql(
                    "select * from user "
                    . "where"
                    . " user_name = \"{$_POST['username']}\""
                    . " and"
                    . " password = \"{$_POST['password']}\""
    );
    $user = array_shift($user);
    if (isset($user->id)) {
        $session->login($user);
        if (empty($_POST['request_uri'])) {
            redirect_to('index.php');
        } else {
            redirect_to($_POST['request_uri']);
        }
    } else {
        $message = "Incorrect credentials";
    }
}
?>

<!-- Page Content -->
<div class="container-fluid">
    <!-- Heading Row -->
    <div class="row">
        <div class="col-md-6 site_logo">
            <img class="img-responsive img-rounded" src="./dependencies/images/wall.jpg" alt="">

            <div class="row">
                <?php
                $about_width = 12;
                include './layouts/site_branding.php';
                ?>
            </div>
        </div>

        <div class="panel panel-default col-md-4 col-md-offset-1">
            <h1>Welcome</h1>
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-block btn-primary" id="login-form-link">Login</a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-block" id="register-form-link">Register</a>
                    </div>
                </div>            
                <h6 class="text-danger text-center">
                    <?php echo $message; ?>
                </h6>
            </div>
            <div class="panel-body">
                <form id="login-form" method="post" role="form" style="display: block;">
                    <div class="form-group">
                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input id="request_uri" name="request_uri" type="hidden" value="<?php echo $session->request_uri(); ?>"/>
                            <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Log In">
                            </div>
                        </div>
                    </div>
                </form>
                <form id="register-form" action="tableForms/insert.php" enctype="multipart/form-data" method="post" role="form" style="display: none;">
                    <?php $object = new User; ?>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="first_name">First Name</label>
                        <input id="first_name" name="first_name" class="form-control" type="text" required value="<?php echo $object->first_name; ?>"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" class="form-control" type="text" required value="<?php echo $object->last_name; ?>"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="user_name">User Name</label>
                        <input id="user_name" name="user_name" class="form-control" type="text" required value="<?php echo $object->user_name; ?>"/>
                        <input name="type" value="client" type="hidden">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="email">Email</label>
                        <input id="email" name="email" class="form-control" type="email" required value="<?php echo $object->email; ?>"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="img">Image</label>
                        <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php if (!$object->id) echo 'required'; ?>/>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="password">Password</label>
                        <input id="password" name="password" class="form-control" type="password" required/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="password2">Repeat Password</label>
                        <input id="password2" name="password2" class="form-control" type="password" required/>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" required><?php echo $object->address; ?></textarea>
                    </div>
                    <div class="row btn-group-vertical col-md-8 col-md-offset-2">
                        <hr>
                        <input id="request_uri" name="request_uri" type="hidden" value="<?php echo $session->request_uri(); ?>"/>
                        <input id="table_name" name="table_name" type="hidden" value="user"/>
                        <input class="form-control btn btn-primary" type="submit" value="Register"/>
                        <hr>
                        <input class="form-control btn btn-default" type="reset" value="Clear"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include './layouts/footer.php'; ?>
<script>
    var activeForm = '#login-form';

    $(function () {
        $('#login-form-link').click(function (e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active btn-primary');
            $(this).addClass('btn-primary');
            activeForm = "#register-form";
            e.preventDefault();
        });
        $('#register-form-link').click(function (e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active btn-primary');
            $(this).addClass('btn-primary');
            activeForm = "#login-form";
            e.preventDefault();
        });
    });

    $(activeForm).validate();
</script>

