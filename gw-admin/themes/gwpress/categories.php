<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Categories</h1>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/admin/categories/add">New</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pagination = new Paginator();
            $pagination_limit = 10;
            $categories = $pagination->pagination($pagination_limit, 'category');
            foreach($categories as $category) {
                echo '<tr>';
                echo '<td>'.$category['id'].'</td>';
                echo '<td>'.$category['title'].'</td>';
                echo '<td><a class="btn btn-warning" href="'.BASE_URL.'/admin/categories/edit?id='.$category['id'].'">Edit</a></td>';
                echo '<td><a class="delete btn btn-danger" href="'.BASE_URL.'/admin/categories/delete?id='.$category['id'].'">Delete</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php $pagination->pagination_links($pagination_limit, 'category'); ?>
    </div>
</div>