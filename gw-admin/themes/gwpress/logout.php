<?php
echo '<meta http-equiv="refresh" content="5; url='.BASE_URL.'">';
$user = new User;
$user->logout();
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">You have been succesfully logged out!</h1>
    <p>You will be redirected to the homepage in 5 seconds...</p>
</div>