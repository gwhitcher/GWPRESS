<?php
//Highlight current item in nav
function echoActiveClassIfRequestMatches($requestUri=array())
{
    $routing_uri = $_SERVER['REQUEST_URI'];
    foreach($requestUri as $ruri) {
        if (strpos($routing_uri, $ruri) !== FALSE)
            echo ' class="active"';
    }
}
//RECURSIVE COPY FUNCTION
function recursive_copy($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recursive_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}