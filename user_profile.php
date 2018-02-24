<?php
require_once './includes/initialize.php';
$current_user = $session->get_user_object();
$id = 0;
if ($current_user->is_admin()) {
    $id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 0;
}
$user_profile = ($id == 0) ? $current_user : User::find_by_id($id);
$object = $user_profile;
$page_title = $user_profile->name();

$nav_only = TRUE;
$page_title = "Welcome";
include './layouts/header.php';
?>

<div class="container">

    <?php if ($user_profile->id): ?>
        <article class="panel panel-primary">
            <h3 class="panel-heading"><?= $user_profile->name(); ?></h3>
            <form id="user_profile" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
                <legend>User Details</legend>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="user_name">User Name</label>
                        <input id="user_name" name="user_name" class="form-control" type="text" required value="<?php echo $object->user_name; ?>"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="email">Email</label>
                        <input id="email" name="email" class="form-control" type="email" required value="<?php echo $object->email; ?>"/>
                    </div>
                </div>
                <legend>Personal Details</legend>
                <div class="form-group row">
                    <label class="col-form-label col-md-2 col-md-offset-1" for="img">
                        <?= $object->avatar("96px", "img img-thumbnail zoom-img"); ?>
                    </label>
                    <div class="col-md-8">
                        <strong>Change Profile Pic</strong>
                        <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php if (!$object->id) echo 'required'; ?>/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="first_name">First Name</label>
                        <input id="first_name" name="first_name" class="form-control" type="text" required value="<?php echo $object->first_name; ?>"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" class="form-control" type="text" required value="<?php echo $object->last_name; ?>"/>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" required><?php echo $object->address; ?></textarea>
                    </div>
                </div>

                <legend>Security Details</legend>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="old_password">Old Password</label>
                        <input id="man_pass" name="man_pass" class="form-control" type="hidden" value="<?= $object->password; ?>"/>
                        <input id="old_password" name="old_password" class="form-control" type="password"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="password">Password</label>
                        <input id="password" name="password" class="form-control" type="password" value="<?= $object->password; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="password2">Repeat Password</label>
                        <input id="password2" name="password2" class="form-control" type="password" value="<?= $object->password; ?>"/>
                    </div>
                </div>
                <div class="btn-group-vertical col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3">
                    <input id="table_name" name="table_name" type="hidden" value="user"/>
                    <input id="id" name="id" class="form-control" type="hidden" readonly value="<?php echo $object->id; ?>"/>
                    <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                    <input class="form-control btn  btn-primary" type="submit" value="Update"/>
                    <input class="form-control btn " type="reset" value="Clear"/>
                </div>
            </form>

            <script>
                var formRules = {
                    rules: {
                        old_password: {
                            equalTo: '#man_pass'
                        },
                        password: {
                            minlength: 6,
                            maxlength: 10
                        },
                        password2: {
                            minlength: 6,
                            equalTo: "#password",
                            maxlength: 10
                        }

                    },
                    messages: {
                        old_password: {
                            equalTo: "Please input your previous password."
                        }
                    }
                };

                $("#user_profile").validate(formRules);
            </script>
        </article>
    <?php else: ?>
        <article class="panel panel-danger">
            <h3 class="panel-heading">
                No User!!
            </h3>
            <div class="panel-body">
                Please login...
            </div>
        </article>
    <?php endif; ?>
</div>

<?php include './layouts/footer.php'; ?>