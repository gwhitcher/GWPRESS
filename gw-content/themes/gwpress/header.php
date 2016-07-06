<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php
    $seo = new SEO();
    $seo->metainfo();
    ?>
    <meta name="author" content="George Whitcher">
    <link rel="icon" href="<?php echo SITE_THEME_URL; ?>/favicon.ico">
    <?php
    $seo->title();
    ?>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_THEME_URL; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo SITE_THEME_URL; ?>/css/custom.css" rel="stylesheet">

    <!-- RSS Feed -->
    <link href="<?php echo BASE_URL; ?>/rss/feed.rss" rel="alternate" type="application/rss+xml" title="<?php echo SITE_TITLE; ?>" />
</head>
<!-- NAVBAR -->
<body>
<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo SITE_TITLE; ?></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php
                    $main_navigation = db_select("SELECT * FROM navigation ORDER BY position ASC");
                    $nav_array = array();
                    foreach ($main_navigation as $nav_item) {
                        $nav_array[] = array('id' => $nav_item['id'], 'parent_id' => $nav_item['parent_id'], 'url' => $nav_item['url'], 'target' => $nav_item['target'], 'title' => $nav_item['title'], 'position' => $nav_item['position']);
                    }
                    $tree = prepareList($nav_array);
                    echo nav($tree);
                    ?>
                    <ul class="nav navbar-nav navbar-right tagline">
                        <li><a href="#"><?php echo SITE_HEADLINE; ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>

<?php $flash = new Flash(); ?>
<?php $flash->flash('flash_message'); ?>