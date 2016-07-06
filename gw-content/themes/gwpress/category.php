<?php
$routing_uri = $_SERVER['REQUEST_URI'];
$category_id = explode("/", $routing_uri);
if(is_numeric($category_id[2])) {
    $id = mysqli_real_escape_string(db_connect(), $category_id[2]);
} else {
    $id = mysqli_real_escape_string(db_connect(), $category_id[3]);
}
$category_lookup = new Category();
$category = $category_lookup->category_load($id);
if(empty($category['featured'])) {
    $category['featured'] = DEFAULT_FEATURED_IMAGE;
}
?>
<header class="intro-header" style="background-image: url('<?php echo BASE_URL;?>/gw-content/uploads/<?php echo $category['featured']; ?>')">&nbsp;</header>
<div class="container">
    <h1 class="page-header"><?php echo $category['title']; ?></h1>
    <p><?php if(!empty($category['description'])) { echo $category['description']; } ?></p>
    <?php
    $searched_id = $category_lookup->category_id_search($category['id'], $id);
    $pagination = new Paginator();
    $pagination_limit = 3;
    $posts = $pagination->pagination($pagination_limit, 'post', ' WHERE category_id = '.$searched_id.' AND status = 1');
    foreach ($posts as $post):
        if(!empty($post['featured'])) {
            echo '<a href="' . BASE_URL . '/blog/' . $post['id'] . '/' . $post['slug'] . '"><img class="img-responsive" src="' . BASE_URL . '/gw-content/uploads/' . $post['featured'] . '" alt="' . $post['title'] . '" /></a>';
        }
        echo '<h2><a href="'.BASE_URL.'/blog/'.$post['id'].'/'.$post['slug'].'">'.$post['title'].'</a></h2>';
        $categories = db_select("SELECT * FROM category WHERE id in (".$post['category_id'].")");
        echo '<div class="small">';
        $created_date = $post['created_date'];
        $posted_date = date("F jS, Y", strtotime($created_date));
        echo '<span class="glyphicon glyphicon-calendar"></span>&nbsp;'.$posted_date;
        echo '&nbsp;&nbsp;';
        echo '<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;';
        foreach($categories as $category) {
            echo '<a href="'.BASE_URL.'/blog/category/'.$category['id'].'/'.$category['slug'].'">'.$category['title'].'</a>&nbsp;';
        }
        echo '</div>';
        $body = Post::read_more($post['body'], 50);
        echo ''.$body.'';
        echo '<hr class="featurette-divider">';
    endforeach;

    //Pagination links
    $pagination->pagination_links($pagination_limit, 'post', ' WHERE status = 1 AND category_id = '.$category['id'].'');
    ?>
</div>