
<?php
$nav_only = TRUE;
$page_title = "Welcome";
include './layouts/header.php';
?>
<!-- Page Content -->
<div class="container-fluid">

    <!-- Heading Row -->
    <div class="row">
        <div class="col-md-8 site_logo" >
            <img class="img-responsive img-rounded" src="./dependencies/images/wall.jpg" alt="">
        </div>
        <!-- /.col-md-8 -->
        <div class="col-md-4">
            <h1><?php echo DEVELOPER_NAME; ?></h1>
            <p>
                I have created this web site for the fulfillment of my <strong>Master's</strong> project.
                As per the guidelines a working project is required in 6th semester of my degree.
                So here it is, <?php echo SITE_TITLE; ?> my own personal project. Created from scratch.
                Made with <span class="glyphicon glyphicon-heart"></span> in Jalandhar.
            </p>
            <?php if ($session->is_logged_in()) { ?>
                <a class="btn btn-primary btn-lg" href="./view_event.php">Get Started</a>
            <?php } else { ?>
                <a class="btn btn-primary btn-lg" href="./login.php">Get Started</a>
            <?php } ?>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Well -->
    <div class="row">
        <div class="col-lg-12">
            <div class="well text-center">
                <?php echo SITE_MOTO; ?>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">       
        <?php include './layouts/site_branding.php'; ?>
    </div>
    <!-- /.row -->

    <!-- Footer -->

</div>

<?php include './layouts/footer.php'; ?>