<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
new User();
User::user_delete($id);