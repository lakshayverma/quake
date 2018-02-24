<table class="table table-striped ">

    <?php
    
    $edit_records = (isset($edit_records)) ? $edit_records : TRUE;
    $renderRow = false;
    if (method_exists(current($table_records), "renderTableHeader")) {
        $renderRow = true;
        echo current($table_records)->renderTableHeader();
    } else {
        ?>
        <thead>
            <tr class="row">
                <?php
                foreach ($table_records[0]->get_db_fields() as $key):
                    ?>
                    <th class="col-sm-12 col-md-2 ">
                        <?php
                        echo ucwords($key);
                    endforeach;
                    ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
        }
        while ($row = current($table_records)) :
            ?>
            <?php
            if (method_exists($row, "renderTableRow") && $renderRow) {
                echo $row->renderTableRow($edit_records);
            } else {
                // Render generic version
                ?>
                <tr class="row">
                    <?php foreach ($row as $value): ?>
                        <?php ?>
                        <td class="col-sm-12 col-md-2">
                            <?php echo $value; ?>
                        </td>

                    <?php endforeach; ?>
                </tr>
                <?php
            }
            next($table_records);
        endwhile;
        ?>
    </tbody>
</table>