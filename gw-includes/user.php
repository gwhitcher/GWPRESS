<?php
class User {

    public function __construct() {
    }

    public static function login($email, $password, $remember_me) {
        $login = db_select_row("SELECT * FROM user where email ='".$email."'");
        if($email == $login['email'] AND hash_equals($login['password'], crypt($password, $login['password']))) {
            if(!empty($remember_me)) {
                $params = session_get_cookie_params();
                setcookie(session_name(), $_COOKIE[session_name('GWPRESS')], time() + 60*60*24*30, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            }
            $_SESSION["email"] = $login['email'];
            $_SESSION["role"] = $login['role'];
            $flash = new Flash();
            $flash->flash('flash_message', 'Logged in!');
            header("Location: ".BASE_URL."/admin/dashboard");
        } else {
            $flash = new Flash();
            $flash->flash('flash_message', 'Username or password incorrect!', 'danger');
            header("Location: ".BASE_URL."/admin/login");
        }
    }

    public static function logout() {
        $flash = new Flash();
        $flash->flash('flash_message', 'Successfully logged out!');
        $_SESSION = array();
        session_destroy();
        unset($_COOKIE['GWPRESS']);
    }

    public static function prtctd() {
        $routing_uri = $_SERVER['REQUEST_URI'];
        if($_SESSION['role'] != 1) {
            $flash = new Flash();
            $flash->flash('flash_message', 'You are not authorized to view this page!', 'danger');
            header("Location: ".BASE_URL."/admin/login");
        } elseif(strpos($routing_uri,'/admin/login') !== FALSE) {
            //Keeps login page free from protection.
        }
    }

    public static function user_load($id) {
        if(empty($id)) {
            $user = array();
            $flash = new Flash();
            $flash->flash('flash_message', 'User does not exist!', 'danger');
            header("Location: ".BASE_URL.'/404');
        } else {
            $user = db_select_row("SELECT * FROM user where id ='".$id."'");
            if(empty($user)) {
                $flash = new Flash();
                $flash->flash('flash_message', 'User does not exist!', 'danger');
                header("Location: ".BASE_URL.'/404');
            }
        }
        return $user;
    }

    public static function user_save($id, $email, $password, $role) {
        $user_email = mysqli_real_escape_string(db_connect(), $email);

        //Password security.
        $user_password = mysqli_real_escape_string(db_connect(), $password);
        $user = new User();
        $hash_password = $user->encrypt_password($user_password);


        $user_role = mysqli_real_escape_string(db_connect(), $role);
        if(empty($id)) {
            db_query("INSERT INTO user (email, password, role) VALUES (".$user_email.", ".$hash_password.", ".$user_role.");");
            $flash = new Flash();
            $flash->flash('flash_message', 'User created!');
            header("Location: ".BASE_URL.'/admin/users/');
        } else {
            db_query("UPDATE ".MYSQL_DB.".user SET email = '".$user_email."', password = '".$hash_password."', role = '".$user_role."' WHERE user.id = ".$id.";");
            $flash = new Flash();
            $flash->flash('flash_message', 'User updated!');
            header("Location: ".BASE_URL.'/admin/users/');
        }
    }

    public static function user_delete($id) {
        if(empty($id)) {
            $flash = new Flash();
            $flash->flash('flash_message', 'User does not exist!', 'danger');
            header("Location: ".BASE_URL.'/admin/users/');
        } else {
            db_query("DELETE FROM user WHERE id = ".$id);
            $flash = new Flash();
            $flash->flash('flash_message', 'User deleted!');
            header("Location: ".BASE_URL.'/admin/users/');
        }
    }

    public function encrypt_password($password) {
        //A higher "cost" is more secure but consumes more processing power
        $cost = 10;

        // Create a random salt
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        // Prefix information about the hash so PHP knows how to verify it later.
        // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Hash the password with the salt
        $hash_password = crypt($password, $salt);

        return $hash_password;
    }

}