<?php
/*
GWPRESS is an open source software developed by George Whitcher http://georgewhitcher.com.
Copyright (c) 2015 George Whitcher
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

//Disable error reporting
error_reporting(0);
ini_set('display_errors', 0);

//Session
ob_start();
session_name('GWPRESS');
session_start();

//GWPRESS VERSION
define('GWPRESS_VERSION', '0.50');

//Configuration
if(file_exists('gw-config.php')) {
    include('gw-config.php');
} else {
    echo 'gw-config.php file does not exist!';
}

//Includes
include($composer.'gw-includes/install.php');
include($composer.'gw-includes/flash.php');
include($composer.'gw-includes/user.php');
include($composer.'gw-includes/post.php');
include($composer.'gw-includes/paginator.php');
include($composer.'gw-includes/page.php');
include($composer.'gw-includes/category.php');
include($composer.'gw-includes/navigation.php');
include($composer.'gw-includes/upload.php');
include($composer.'gw-includes/search.php');
include($composer.'gw-includes/contact.php');
include($composer.'gw-includes/db.php');
include($composer.'gw-includes/routes.php');
include($composer.'gw-includes/seo.php');

//Plugins routes include
$plugin_dir = new RecursiveDirectoryIterator(BASE_DIR."/gw-content/plugins");
$template_path = 'gw-content/plugins';
$routing_uri = $_SERVER['REQUEST_URI'];
foreach(new RecursiveIteratorIterator($plugin_dir) as $file) {
    if(strpos($file,'plugin.php') !== FALSE) {
        include_once($file);
    }
}

//MYSQL Check
$mysql_connection_test = db_select("SELECT * FROM user");
if(empty($mysql_connection_test)) {
    echo 'Could not connect to database.  Please check your MySQL information.';
}

//Template based off URI
if (strpos($routing_uri,'/admin/login') !== false) {
    $template_path = $composer.'gw-admin/themes/'.ADMIN_THEME.'';
    include($template_path.'/login.php');
} elseif(strpos($routing_uri,'/admin/ajax') !== false) {
} elseif(strpos($routing_uri,'/admin/plugin') !== false) {
    $template_path = $composer.'gw-admin/themes/'.ADMIN_THEME.'';
    include($template_path . '/functions.php');
    include($template_path . '/header.php');
    //Plugins
    $plugin_dir = new RecursiveDirectoryIterator(BASE_DIR."/gw-content/plugins");
    $template_path = 'gw-content/plugins';
    $routing_uri = $_SERVER['REQUEST_URI'];
    foreach(new RecursiveIteratorIterator($plugin_dir) as $file) {
        if(strpos($file,'plugin.php') !== FALSE) {
            include_once($file);
            foreach($plugin_routes as $p_route) {
                if(strpos($routing_uri,$p_route['plugin_url']) !== FALSE) {
                    $page_name = $p_route['plugin_page_name'];
                    include_once($template_path.'/'.$page_name);
                }
            }
        }
    }
    $template_path = $composer.'gw-admin/themes/'.ADMIN_THEME.'';
    include($template_path.'/footer.php');
} elseif(strpos($routing_uri,'/admin') !== false) {
    $template_path = $composer.'gw-admin/themes/'.ADMIN_THEME.'';
    include($template_path.'/functions.php');
    include($template_path.'/header.php');
    include($template_path.'/'.$page_name);
    include($template_path.'/footer.php');
}  elseif(strpos($routing_uri,'/install') !== false) {
    $template_path = $composer.'gw-content/themes/'.SITE_THEME.'';
    include($template_path.'/'.$page_name);
} elseif(strpos($routing_uri,'/rss') !== false) {
    $template_path = $composer.'gw-content/themes/'.SITE_THEME.'';
    include($template_path.'/'.$page_name);
} elseif(strpos($routing_uri,'/sitemap') !== false) {
    $template_path = $composer.'gw-content/themes/'.SITE_THEME.'';
    include($template_path.'/'.$page_name);
} else {
    $template_path = $composer.'gw-content/themes/'.SITE_THEME.'';
    include($template_path.'/functions.php');
    include($template_path.'/header.php');
    include($template_path.'/'.$page_name);
    include($template_path.'/footer.php');
}