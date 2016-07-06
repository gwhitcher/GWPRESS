<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        $posts = db_select("SELECT * FROM post WHERE status = 1 AND slider = 1 ORDER BY id DESC LIMIT 5");
        $i = 0;
        foreach($posts as $post) {
            if($i == 0) {
                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
            } else {
                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
            }
            $i++;
        }
        ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php
        $i = 1;
        foreach ($posts as $post):
            $item_class = ($i == 1) ? 'item active' : 'item';
            echo '<div class="'.$item_class.'" style="background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('.BASE_URL.'/gw-content/uploads/'.$post['featured'].'); background-repeat: no-repeat; background-size: 100%; background-position: 50%;">';
            echo '<a href="'.BASE_URL.'/blog/'.$post['id'].'/'.$post['slug'].'">';
            echo '<img class="img-responsive" src="'.BASE_URL.'/gw-content/uploads/'.$post['featured'].'" />';
                echo '<div class="container">';
                echo '<div class="carousel-caption">';
                echo '<h1>'.$post['title'].'</h1>';
                $body = Post::read_more($post['body'], 50);
                echo ''.$body.'';
                echo '</div>';
                echo '</div>';
            echo '</a>';
            echo '</div>';
            $i++;
        endforeach;
        ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->

<div class="container home">

    <h1 class="page-header">Welcome</h1>
    <br/>

    <?php
    $pagination = new Paginator();
    $pagination_limit = 3;
    $posts = $pagination->pagination($pagination_limit, 'post', ' WHERE status = 1');
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
        echo $body;
        echo '<hr class="featurette-divider">';
    endforeach;

    //Pagination links
    $pagination->pagination_links($pagination_limit, 'post', ' WHERE status = 1');
    ?>
</div>