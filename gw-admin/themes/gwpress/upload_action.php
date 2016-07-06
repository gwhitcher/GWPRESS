<?php
    $file = $_FILES['file_upload'];
    $directory = mysqli_real_escape_string(db_connect(),$_POST['directory']);
    if (substr($directory, -1) != '/') {
        $directory = ''.$directory.'/';
    }
    $upload = new Upload();
    $upload->upload($file, $directory);