<?php
$contact = new Contact();
    if(!empty($_POST)) {
        $subject = mysqli_real_escape_string(db_connect(), $_POST['subject']);
        $name = mysqli_real_escape_string(db_connect(), $_POST['name']);
        $email = mysqli_real_escape_string(db_connect(), $_POST['email']);
        $message = mysqli_real_escape_string(db_connect(), $_POST['message']);
        $contact->contact($subject, $name, $email, $message);
    }
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<header class="intro-header" style="background-image: url('<?php echo BASE_URL;?>/gw-content/uploads/<?php echo DEFAULT_FEATURED_IMAGE; ?>')">&nbsp;</header>
<div class="container">
        <h1 class="page-header">Contact</h1>

        <form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/contact">

            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <textarea id="message" name="message" class="form-control" rows="3" placeholder="Message" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="captcha" class="col-sm-2 control-label">Captcha</label>
                <div class="col-sm-10">
                    <div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_KEY; ?>"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
</div>