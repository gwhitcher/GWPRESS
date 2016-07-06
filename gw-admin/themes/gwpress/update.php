<?php
$zip_url = 'https://github.com/gwhitcher/GWPRESS/archive/'; //URL TO ZIP
$zip_name = 'master.zip'; //ZIP FILENAME
$src_dir = 'GWPRESS-master'; //SOURCE DIRECTORY (the name of the root folder in the zip)
$dest_dir = BASE_DIR; //DESTINATION DIRECTORY
$mysql_dir = ''.$dest_dir.'/gw-admin/themes/gwpress/assets/mysql/updates'; //DESTINATION TO MYSQL UPDATE FILES
$mysql_order = 0; //CHANGE TO 1 TO REVERSE ORDER

//MYSQL
$servername = MYSQL_SERVERNAME;
$username = MYSQL_USERNAME;
$password = MYSQL_PASSWORD;
$dbname = MYSQL_DB;

ini_set('max_execution_time', 300); // EXTENDING EXECUTION TIME: 300 seconds = 5 minutes

if(!empty($_POST['submit'])) {
    $hostfile = fopen($zip_url . $zip_name, 'r');
    $fh = fopen($zip_name, 'w');

    while (!feof($hostfile)) {
        $output = fread($hostfile, 8192);
        fwrite($fh, $output);
    }

    fclose($hostfile);
    fclose($fh);

    require_once('assets/pclzip/pclzip.lib.php');
    $archive = new PclZip($zip_name);

    if (($v_result_list = $archive->extract()) == 0) {
        die("Error : ".$archive->errorInfo(true));
    }

    unlink($zip_name); //DELETE ZIP

    recursive_copy($src_dir,$dest_dir); //COPY FILES

    if(SYSTEM_OS == 1) {
        system('rd /Q /S "' . $src_dir . '"'); //WINDOWS DELETE
    } else {
        system('/bin/rm -rf ' . escapeshellarg($src_dir)); //LINUX DELETE
    }

    include('assets/mysql/mysql_update.php'); //UPDATE MYSQL

    $flash = new Flash();
    $flash->flash('flash_message', 'Updater finished!');
    header("Location: ".BASE_URL.'/admin/update/');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Update GWPRESS</h1>
    <p>By clicking submit below you will download the latest files for GWPRESS directly from it's Github repository.</p>
    <form method="post">
        <input name="submit" type="submit" value="Submit" class="btn btn-default" />
    </form>
</div>