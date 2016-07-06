<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
new Page();
Page::page_delete($id);