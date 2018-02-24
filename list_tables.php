<?php
$table = (isset($_GET["table"])) ? $_GET["table"] : "person";
$page_title = "Listing " . ucwords($table) . " table";

$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

$first_record = 0;
if (isset($_GET['id'])) {
    $record_id = $_GET['id'];
    $page = floor($record_id / $limit) + 1;

    $first_record = $record_id - 1;
}

$prev_page = ($page > 1) ? ($page - 1) : 1;
$next_page = $page + 1;
$nav_only = TRUE;
include './layouts/header.php';
admins_only();
?>
<div class="container-fluid">
    <?php
    global $database;
    if ($table) {
        $table_records = $table::find_limited($limit, $page);
    }
    ?>
    <nav id="select_tables" class="navbar">
        <div class="navbar-header">
            <a class="navbar-toggle" data-toggle="collapse" data-target="#table_list">
                <span class="glyphicon glyphicon-chevron-down"></span>
            </a>
            <a class="navbar-brand" href="#">Tables </a>
        </div>
        <div id="table_list" class="navbar-collapse collapse" data-spy="affix" data-offset-top="300">
            <ul class="nav navbar-nav">
                <?php
                $tables = get_all_tables();
                while (($rec = current($tables)) !== FALSE):
                    ?>
                    <li class=" <?php echo (strcasecmp($table, key($tables)) == 0) ? "current active" : ""; ?>">
                        <a href="?table=<?php echo key($tables); ?>"><?php echo ucfirst(key($tables)); ?></a>
                    </li>
                    <?php
                    next($tables);
                endwhile;
                ?>
            </ul>
        </div>
    </nav>

    <article id="details" class="panel panel-info">
        <h3 class="panel-heading"><?php echo ucfirst($table); ?></h3>
        <div class="panel-body">
            <a id="record-<?= $first_record; ?>"></a>
            <div class="table-responsive">
                <?php
                if ($table_records) {
                    include '/layouts/table_render.php';
                } else {
                    ?>
                    <p class="text-danger">
                    <big>No records found...</big>
                    Try other tables or different page number.
                    </p>
                </div>
            <?php }; ?>
        </div>

        <div class="panel-footer">
            <ul class="pager">
                <li class="previous"><a href="?table=<?= $table; ?>&page=<?= $prev_page; ?>&limit=<?= $limit; ?>">Previous</a></li>
                <li class="next"><a href="?table=<?= $table; ?>&page=<?= $next_page; ?>&limit=<?= $limit; ?>">Next</a></li>
            </ul>
        </div>

    </article>

    <?php
    $formFile = "./tableForms/{$table
            }form.php";
    if (file_exists($formFile)) {
        include $formFile;
        $form = TRUE;
    } else {
        $form = FALSE;
        ?>
        <div class="container-fluid">
            <h4 class="text-danger">
                Could not find the Form for inserting new rows.
            </h4>
        </div>
        <?php
    }
    ?>

    <?php
    if (!$object->id) {
        $record = 1;
    } else {
        $record = $object->id;
    }
    ?>

    <a id="to_record" href="#record-<?= $record - 1; ?>" title="To the reocrd's row">
        <span class="glyphicon glyphicon-menu-up"></span>
    </a>

</div>

<?php include './layouts/footer.php'; ?>

<?php if ($form): ?>
    <script>
        $("#form .btn-group-vertical:last").append("<a class=\"btn btn-default\" href=\"./list_tables.php?table=<?php echo $table; ?>\">Insert a new Record</a>");
        $("#form").validate(formRules);
    <?php
    if ($object->id != '') {
        ?>
            $("html, body").animate({scrollTop: $("#form").parent().offset().top}, 500);
            $("#form").prev().html("Update");
        <?php
    } else {
        ?>
            $("html, body").animate({scrollTop: $("#details").parent().offset().top}, 500);
    <?php } ?>
    </script>
<?php endif; ?>