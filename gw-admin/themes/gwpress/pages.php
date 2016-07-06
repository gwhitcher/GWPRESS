<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Pages</h1>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/admin/pages/add">New</a>
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
            $pages = $pagination->pagination($pagination_limit, 'page');
            foreach($pages as $page) {
                echo '<tr>';
                echo '<td>'.$page['id'].'</td>';
                echo '<td>'.$page['title'].'</td>';
                echo '<td><a class="btn btn-warning" href="'.BASE_URL.'/admin/pages/edit?id='.$page['id'].'">Edit</a></td>';
                echo '<td><a class="delete btn btn-danger" href="'.BASE_URL.'/admin/pages/delete?id='.$page['id'].'">Delete</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php $pagination->pagination_links($pagination_limit, 'page'); ?>
    </div>
</div>