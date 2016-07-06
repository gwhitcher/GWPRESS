<?php
//Password protects all administration pages.
new User();
User::prtctd();

//Pages array
$pages_array = array
(
    array(
        "Dashboard",
        "".BASE_URL."/admin/dashboard",
        array('admin/dashboard'),
        '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'
    ),
    array(
        "Posts",
        "".BASE_URL."/admin/posts",
        array('admin/posts', 'admin/posts/add', 'admin/posts/edit'),
        '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'
    ),
    array(
        "Categories",
        "".BASE_URL."/admin/categories",
        array('admin/categories', 'admin/categories/add', 'admin/categories/edit'),
        '<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>'
    ),
    array(
        "Pages",
        "".BASE_URL."/admin/pages",
        array('admin/pages', 'admin/pages/add', 'admin/pages/edit'),
        '<span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>'
    ),
    array(
        "Uploads",
        "".BASE_URL."/admin/uploads",
        array('admin/uploads'),
        '<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>'
    ),
    array(
        "Navigation",
        "".BASE_URL."/admin/navigation",
        array('admin/navigation', 'admin/navigation/add', 'admin/navigation/edit'),
        '<span class="glyphicon glyphicon-link" aria-hidden="true"></span>'
    ),
    array(
        "Search",
        "".BASE_URL."/admin/search",
        array('admin/search'),
        '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>'
    ),
    array(
        "Update",
        "".BASE_URL."/admin/update",
        array('admin/update'),
        '<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>'
    ),
    array(
        "Users",
        "".BASE_URL."/admin/users",
        array('admin/users', 'admin/users/add', 'admin/users/edit'),
        '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>'
    ),
    array(
        "Logout",
        "".BASE_URL."/admin/logout",
        array('admin/logout'),
        '<span class="glyphicon glyphicon-off" aria-hidden="true"></span>'
    )
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo METADESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo METAKEYWORDS; ?>">
    <meta name="author" content="George Whitcher">
    <link rel="icon" href="<?php echo ADMIN_THEME_URL;?>/favicon.ico">

    <title>Administration: <?php echo SITE_TITLE; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ADMIN_THEME_URL; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo ADMIN_THEME_URL; ?>/css/dashboard.css" rel="stylesheet">

    <!-- Assets -->
    <link href="<?php echo ADMIN_THEME_URL; ?>/assets/selectize/selectize.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME_URL; ?>/assets/selectize/selectize.bootstrap3.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME_URL; ?>/assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!-- Javascript (need to load jquery in header) -->
    <script src="<?php echo ADMIN_THEME_URL; ?>/js/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body onload="load()">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>/admin/dashboard"><?php echo SITE_TITLE; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach($pages_array as $page) { ?>
                            <li<?php echoActiveClassIfRequestMatches($page[2]); ?>><a href="<?php echo $page[1]; ?>"><?php echo $page[3];?> <?php echo $page[0]; ?></a></li>
                        <?php } ?>
                        <?php
                        if(!empty($plugins)) {
                            foreach($plugins as $plugin_item) {
                                $plugin_url = array($plugin_item['plugin_url']);
                                ?>
                                <li<?php echoActiveClassIfRequestMatches($plugin_url); ?>><a href="<?php echo BASE_URL.'/'.$plugin_item['plugin_url']; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $plugin_item['plugin_title']; ?></a></li>
                            <?php }} ?>
                    </ul>
                </li>
                <li><a href="<?php echo BASE_URL; ?>/admin">Dashboard</a></li>
                <li><a href="http://georgewhitcher.com" target="_blank">Help</a></li>
            </ul>
            <form class="navbar-form navbar-right" method="get" action="<?php echo BASE_URL;?>/admin/search">
                <input type="hidden" id="category" name="category" value="post">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <?php foreach($pages_array as $page) { ?>
                    <li<?php echoActiveClassIfRequestMatches($page[2]); ?>><a href="<?php echo $page[1]; ?>"><?php echo $page[3];?> <?php echo $page[0]; ?></a></li>
                <?php } ?>
                <?php
                if(!empty($plugins)) {
                    foreach($plugins as $plugin_item) {
                        $plugin_url = array($plugin_item['plugin_url']);
                        ?>
                        <li<?php echoActiveClassIfRequestMatches($plugin_url); ?>><a href="<?php echo BASE_URL.'/'.$plugin_item['plugin_url']; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $plugin_item['plugin_title']; ?></a></li>
                <?php }} ?>
            </ul>

            <footer id="gw_footer">
                <p>&copy; Copyright <?php echo date('Y'); ?> <?php echo SITE_TITLE; ?> - All Rights Reserved. - Powered by <a href="http://georgewhitcher.com" target="_blank">GWPRESS</a> v<?php echo GWPRESS_VERSION; ?></p>
            </footer>
        </div>
    </div>
<?php $flash = new Flash(); ?>
<?php $flash->flash('flash_message'); ?>