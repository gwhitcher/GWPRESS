<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
$info = new User();
$user = $info->user_load($id);
if(!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    new User();
    User::user_save($id, ''.$email.'', ''.$password.'', ''.$role.'');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">User: <?php echo $user['email'];?></h1>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/users/edit?id=<?php echo $id;?>">

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $user['email'];?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
        </div>

        <div class="form-group">
            <label for="role" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
                <select class="form-control" name="role" id="role">
                    <option <?php if($user['role'] == 0) echo 'selected="selected"'; ?> value="0">Guest</option>
                    <option <?php if($user['role'] == 1) echo 'selected="selected"'; ?> value="1">Admin</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
        </div>

    </form>
</div>