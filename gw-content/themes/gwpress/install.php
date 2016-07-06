<?php
if(defined(BASE_URL) OR defined(UPLOAD_DIR) OR defined(SITE_TITLE) OR defined(SITE_THEME) OR defined(ADMIN_THEME) OR defined(MYSQL_SERVERNAME) OR defined(MYSQL_USERNAME) OR empty(MYSQL_DB)) {
    $flash = new Flash();
    $flash->flash('flash_message', 'Please fix your gw-config.php!', 'danger');
} else {
    if (mysqli_ping(db_connect()))
    {
        $install = new Install();
        $install->install();
    }
    else
    {
        $flash = new Flash();
        $flash->flash('flash_message', 'Could not connect to database!', 'danger');
    }
}