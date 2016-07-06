 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
     <h1 class="page-header">Dashboard</h1>
     <h2 class="sub-header">Recent Posts</h2>
     <a class="btn btn-success" href="<?php echo BASE_URL; ?>/admin/posts/add">New</a>
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
             $posts = db_select("SELECT * FROM post ORDER BY id DESC LIMIT 5");
             foreach($posts as $post) {
                 echo '<tr>';
                 echo '<td>'.$post['id'].'</td>';
                 echo '<td>'.$post['title'].'</td>';
                 echo '<td><a class="btn btn-warning" href="'.BASE_URL.'/admin/posts/edit?id='.$post['id'].'">Edit</a></td>';
                 echo '<td><a class="delete btn btn-danger"" href="'.BASE_URL.'/admin/posts/delete/'.$post['id'].'">Delete</a></td>';
                 echo '</tr>';
             }
             ?>
             </tbody>
         </table>
     </div>

     <h2 class="sub-header">Recent Pages</h2>
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
             $pages = db_select("SELECT * FROM page ORDER BY id DESC LIMIT 5");
             foreach($pages as $page) {
                 echo '<tr>';
                 echo '<td>'.$page['id'].'</td>';
                 echo '<td>'.$page['title'].'</td>';
                 echo '<td><a class="btn btn-warning" href="'.BASE_URL.'/admin/pages/edit?id='.$page['id'].'">Edit</a></td>';
                 echo '<td><a class="delete btn btn-danger"" href="'.BASE_URL.'/admin/pages/delete/'.$page['id'].'">Delete</a></td>';
                 echo '</tr>';
             }
             ?>
             </tbody>
         </table>
     </div>
 </div>