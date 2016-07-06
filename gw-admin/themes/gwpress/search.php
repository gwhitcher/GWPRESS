<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Search</h1>
    <form class="form-horizontal" enctype="multipart/form-data" method="get" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/search">

        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Keyword</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword" <?php if(!empty($_GET['keyword'])) { echo 'value="'.$_GET['keyword'].'"'; } ?> required>
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
                <?php if(empty($_GET['category'])) {
                    $category = 'all';
                } else {
                    $category = $_GET['category'];
                }; ?>
                <label class="radio-inline">
                    <input type="radio" id="category" name="category" value="all" <?php if($category == 'all') { echo 'checked="checked"'; } ?>>All
                </label>
                <label class="radio-inline">
                    <input type="radio" id="category" name="category" value="post" <?php if($category == 'post') { echo 'checked="checked"'; } ?>>Post
                </label>
                <label class="radio-inline">
                    <input type="radio" id="category" name="category" value="category" <?php if($category == 'category') { echo 'checked="checked"'; } ?>>Category
                </label>
                <label class="radio-inline">
                    <input type="radio" id="category" name="category" value="page" <?php if($category == 'page') { echo 'checked="checked"'; } ?>>Page
                </label>
                <label class="radio-inline">
                    <input type="radio" id="category" name="category" value="upload" <?php if($category == 'upload') { echo 'checked="checked"'; } ?>>Upload
                </label>
                <label class="radio-inline">
                    <input type="radio" id="category" name="category" value="user" <?php if($category == 'user') { echo 'checked="checked"'; } ?>>User
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
if(!empty($_GET['keyword'])) {
    if(!empty($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    } else {
        $keyword = '';
        $_GET['keyword'] = '';
    }
    if(!empty($_GET['category'])) {
        $category = $_GET['category'];
    } else {
        $category = '';
        $_GET['category'] = '';
    }
    $search = new Search();
    $search_results = $search->search_query(''.$keyword.'', ''.$category.'');

    echo '<div class="container">';

    if($category === 'post') {
        echo '<h2 class="sub-header">Posts results for "'.$keyword.'":</h2>';
        echo '<ul>';
        foreach ($search_results as $result) {
            echo '<li><a href="'.BASE_URL.'/admin/posts/edit?id='.$result['id'].'">'.$result['title'].'</a></li>';
        }
        echo '</ul>';
    } elseif($category === 'category') {
        echo '<h2 class="sub-header">Category results for "'.$keyword.'":</h2>';
        echo '<ul>';
        foreach ($search_results as $result) {
            echo '<li><a href="'.BASE_URL.'/admin/categories/edit?id='.$result['id'].'">'.$result['title'].'</a></li>';
        }
        echo '</ul>';
    } elseif($category === 'page') {
        echo '<h2 class="sub-header">Page results for "'.$keyword.'":</h2>';
        echo '<ul>';
        foreach ($search_results as $result) {
            echo '<li><a href="'.BASE_URL.'/admin/pages/edit?id='.$result['id'].'">'.$result['title'].'</a></li>';
        }
        echo '</ul>';
    } elseif($category === 'upload') {
        echo '<h2 class="sub-header">Upload results for "'.$keyword.'":</h2>';
        echo '<ul>';
        foreach ($search_results as $result) {
            echo '<li><a href="'.BASE_URL.'/admin/uploads/edit?id='.$result['id'].'">'.$result['filename'].'</a></li>';
        }
        echo '</ul>';
    } elseif($category === 'user') {
        echo '<h2 class="sub-header">User results for "'.$keyword.'":</h2>';
        echo '<ul>';
        foreach ($search_results as $result) {
            echo '<li><a href="'.BASE_URL.'/admin/users/edit?id='.$result['id'].'">'.$result['username'].'</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<h2 class="sub-header">All results for "'.$keyword.'":</h2>';
        echo '<ul>';
        print($search_results);
        echo '</ul>';
    }
    echo '</div>';
}
?>