<?php
$id = mysqli_real_escape_string(db_connect(),$_GET['file']);
$upload = new Upload();
$upload->delete_file($id);