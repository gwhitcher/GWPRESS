<?php
if(!empty($_POST)) {
    $email = mysqli_real_escape_string(db_connect(), $_POST['inputEmail']);
    $password = mysqli_real_escape_string(db_connect(), $_POST['inputPassword']);
    $remember_me = mysqli_real_escape_string(db_connect(), $_POST['remember_me']);
    $user = new User();
    $user->login($email, $password, $remember_me);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login: <?php echo SITE_TITLE; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ADMIN_THEME_URL;?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo ADMIN_THEME_URL; ?>/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php $flash = new Flash(); ?>
<?php $flash->flash('flash_message'); ?>
<div class="container">
    <form class="form-signin" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="remember_me" name="remember_me" value="remember_me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit" name="submit">Sign in</button>
    </form>

</div> <!-- /container -->
<script src="<?php echo ADMIN_THEME_URL; ?>/js/jquery.min.js"></script>
<script src="<?php echo ADMIN_THEME_URL; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo ADMIN_THEME_URL; ?>/js/default.js"></script>
</body>
</html>
