<?php include '../includes/initialize.php'; ?>
<?php
$table = $_POST["table_name"];
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $object = $table::find_by_id($_POST['id']);
} else {
    $object = new $table;
}
$attrs = $object->attributes();

foreach ($_POST as $attribute => $value) {
    if ($attribute == "table_name" || $attribute == "id") {
        continue;
    }
    if (array_key_exists($attribute, $attrs) && !empty($value)) {
        $object->$attribute = $value;
    } else if (property_exists($table, $attribute)) {
        $object->$attribute = $value;
    }
}
?>
<?php
if ($object->validate_attributes($object->insertion_attributes())) {
    if (!empty($_FILES['img']['name'])) {
        $object->img = $object->upload_img($_FILES['img']);
    }
    $object->save();
    if ($table == 'user' && !$session->get_user_object() instanceof User) {
//        $session->login($object);
//        redirect_to("../" . $session->request_uri());
//        exit();
    }
    
    $redirect_url = (isset($_POST['redirect_url'])) ? $_POST['redirect_url'] : "../index.php";
    redirect_to($redirect_url);
} else {
    echo 'Errors';
}
?>
<pre>
    <?php print_r($_POST); ?>
</pre>
<pre>
    <?php print_r($object); ?>
</pre>