<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
new Post();
Post::post_delete($id);