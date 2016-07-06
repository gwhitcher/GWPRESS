<?php
$routing_uri = $_SERVER['REQUEST_URI'];
$post_id = explode("/", $routing_uri);
if(is_numeric($post_id[1])) {
    $id = mysqli_real_escape_string(db_connect(), $post_id[1]);
} else {
    $id = mysqli_real_escape_string(db_connect(), $post_id[2]);
}
$post_class = new Post();
$post = $post_class->post_load($id);
if(empty($post['featured'])) {
    $post['featured'] = DEFAULT_FEATURED_IMAGE;
}
?>
<header class="intro-header" style="background-image: url('<?php echo BASE_URL;?>/gw-content/uploads/<?php echo $post['featured']; ?>')">&nbsp;</header>
<div class="container">
    <h1 class="page-header"><?php echo $post['title']; ?></h1>
    <?php echo eval("?>".$post['body']."");?>
    <?php if(COMMENTS_ACTIVE == 1) { echo DISQUS; } ?>
</div>