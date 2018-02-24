<!Doctype html>
<?php
require_once('includes/initialize.php');
global $session;
if (!isset($current_user)) {
    $current_user = $session->get_user_object();
}
?>
<html lang="en">
    <head>
        <?php include 'layouts/site_dependencies.php'; ?>
    </head>
    <body>
        <?php if (isset($custom_header) && $custom_header): ?>
        <?php else: ?>
            <?php include 'site_header.php'; ?>
        <?php endif; ?>

        <?php if ($session->message()): ?>
            <div class="alert alert-info alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="text-center">
                    <strong>Message: </strong>
                    <?php echo $session->message(); ?>
                </span>
            </div>
        <?php endif; ?>