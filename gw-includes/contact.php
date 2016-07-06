<?php
class Contact {

    public function __construct() {
    }

    public static function contact($email_subject = '', $email_name = '', $email_address = '', $email_message = '') {

        if(isset($_POST['g-recaptcha-response']))
            $captcha=$_POST['g-recaptcha-response'];

        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".CAPTCHA_SECRET."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        if($response['success'] == false)
        {
            $flash = new Flash();
            $flash->flash('flash_message', 'Captcha field not filled out!', 'warning');
            header("Location: ".BASE_URL.'/contact/');
        }
        else
        {
            $to = CONTACT_EMAIL;
            $from = $email_address;
            //$to = "".$email_address.", somebodyelse@example.com";

            $message = "<html>
                        <head>
                        <title>".$email_subject."</title>
                        </head>
                        <body style='background:#000; font-family: 'Arial', sans-serif;'>
<div style='width: 800px; margin: 0 auto; border: 2px solid #CCC; border-radius: 5px; background: #FFF;'>
                        From: ".$email_name."<br />
                        Email: ".$email_address."<br />
                        Message: ".htmlspecialchars($email_message)."
                        </div>
                        </body>
                        </html>
                        ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: '.$from.''."\r\n";
            //$headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($to,$email_subject,$message,$headers);

            $flash = new Flash();
            $flash->flash('flash_message', 'Form submitted!  Someone will get back to you shortly.');
            header("Location: ".BASE_URL.'/contact/');
        }
    }
}