<?php
$routing_uri = $_SERVER['REQUEST_URI'];
$page_slug = explode("/", $routing_uri);
$page_slug[1] = strtok($page_slug[1], '?');
$slug = mysqli_real_escape_string(db_connect(), $page_slug[1]);
$page_lookup = new Page();
$page = $page_lookup->page_load_slug($slug);
if(empty($page['slug'])) {
    include_once('404.php');
} else {
?>
<header class="intro-header" style="background-image: url('<?php echo BASE_URL;?>/gw-content/uploads/<?php echo $page['featured']; ?>')">&nbsp;</header>

<div class="container">
    <h1 class="page-header"><?php echo $page['title']; ?></h1>
    <?php echo eval("?>".$page['body']."");?>
</div>
<?php } ?>