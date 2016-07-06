<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Users</h1>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/admin/users/add">New</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pagination = new Paginator();
            $pagination_limit = 10;
            $users = $pagination->pagination($pagination_limit, 'user');
            foreach($users as $user) {
                echo '<tr>';
                echo '<td>'.$user['id'].'</td>';
                echo '<td>'.$user['email'].'</td>';
                echo '<td><a class="btn btn-warning" href="'.BASE_URL.'/admin/users/edit?id='.$user['id'].'">Edit</a></td>';
                echo '<td><a class="delete btn btn-danger" href="'.BASE_URL.'/admin/users/delete?id='.$user['id'].'">Delete</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php $pagination->pagination_links($pagination_limit, 'user'); ?>
    </div>
</div>