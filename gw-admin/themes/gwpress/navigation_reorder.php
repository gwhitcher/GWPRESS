<?php
foreach ($_POST['item'] as $key => $value) {
    $navigation = db_select_row("SELECT * FROM navigation WHERE id = ".$value.";");
    $navigation['position'] = $key + 1;
    db_query("UPDATE ".MYSQL_DB.".navigation SET position = '".$navigation['position']."' WHERE id = ".$navigation['id'].";");
}