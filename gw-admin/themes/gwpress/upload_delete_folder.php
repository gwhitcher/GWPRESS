<?php
$folder = mysqli_real_escape_string(db_connect(), $_POST['folder']);
$upload = new Upload();
$upload->delete_folder($folder);