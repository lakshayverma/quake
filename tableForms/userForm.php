<?php
if (isset($_GET['id'])) {
    $object = User::find_by_id($_GET['id']);
} else {
    $object = new User();
}
?>
<div class="container-fluid">

    <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3 class="panel-heading text-capitalize">Insert new User</h3>

        <form id="form" class="panel-body" method="post" action="tableForms/insert.php" enctype="multipart/form-data">
            <?php if ($object->id): ?>
                <div class="form-group col-md-2">
                    <label class="col-form-label" for="id">Id</label>
                    <input id="id" name="id" class="form-control" type="number" readonly value="<?php echo $object->id; ?>"/>
                </div>
            <?php endif; ?>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="user_name">User Name</label>
                <input id="user_name" name="user_name" class="form-control" type="text" required value="<?php echo $object->user_name; ?>"/>
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label" for="email">Email</label>
                <input id="email" name="email" class="form-control" type="email" required value="<?php echo $object->email; ?>"/>
            </div>
            <div class="form-group  col-md-2">
                <label class="col-form-label" for="type">User Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    <option value="client">Client</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="col-form-label" for="img">Image</label>
                <input id="img" name="img" class="form-control" type="file" accept="image/*" <?php if (!$object->id) echo 'required'; ?>/>
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label" for="first_name">First Name</label>
                <input id="first_name" name="first_name" class="form-control" type="text" required value="<?php echo $object->first_name; ?>"/>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="last_name">Last Name</label>
                <input id="last_name" name="last_name" class="form-control" type="text" required value="<?php echo $object->last_name; ?>"/>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="password">Password</label>
                <input id="password" name="password" class="form-control" type="password" value="<?php echo $object->password; ?>" />
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="password2">Repeat Password</label>
                <input id="password2" name="password2" class="form-control" type="password" value="<?php echo $object->password; ?>"/>
            </div>
            <div class="form-group col-md-12">
                <label class="col-form-label" for="address">Address</label>
                <textarea id="address" name="address" class="form-control" required><?php echo $object->address; ?></textarea>
            </div>
            <br>
            <div class="btn-group-vertical col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3">
                <input id="table_name" name="table_name" type="hidden" value="user"/>
                <input id="redirect_url" name="redirect_url" type="hidden" readonly value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
                <input class="form-control btn  btn-primary" type="submit" value="User"/>
                <input class="form-control btn " type="reset" value="Clear"/>
            </div>
        </form>
    </div>
</div>

<script>
    var formRules = {
        rules: {
            first_name: "required",
            last_name: "required",
            user_name: {
                required: true,
                minlength: 6
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 10
            },
            password2: {
                required: true,
                minlength: 6,
                equalTo: "#password",
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            user_name: {
                required: "You must provide a user name to login in future.",
                minlength: "Make username long so it is unique."
            },
            password2: {
                equalTo: "Passwords should match."
            }
        }
    };
</script>