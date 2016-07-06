<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
new Navigation();
Navigation::navigation_delete($id);