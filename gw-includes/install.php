<?php
class Install {

        public function __construct() {
        }

        public static function install() {
                //Check if database is already installed
                $database_lookup = db_select("SELECT * FROM user");
                if(!empty($database_lookup)) {
                        $flash = new Flash();
                        $flash->flash('flash_message', 'GWPRESS already installed!  Remember to remove your install.php from your theme directory.', 'danger');
                        header("Location: ".BASE_URL."");
                } else {
                        //Create post table
                        $sql = "CREATE TABLE post (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
category_id VARCHAR(255),
title VARCHAR(255),
slug VARCHAR(255),
body TEXT,
featured TEXT,
status INT(11),
slider INT(11),
metadescription VARCHAR(160),
metakeywords VARCHAR(255),
created_date DATETIME,
updated_date DATETIME
)";
                        db_query($sql);

                        //Create category table
                        $sql = "CREATE TABLE category (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255),
slug VARCHAR(255),
description TEXT,
featured TEXT,
metadescription VARCHAR(160),
metakeywords VARCHAR(255)
)";
                        db_query($sql);

                        //Create page table
                        $sql = "CREATE TABLE page (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255),
slug VARCHAR(255),
body TEXT,
featured TEXT,
metadescription VARCHAR(160),
metakeywords VARCHAR(255)
)";
                        db_query($sql);

                        //Create user table
                        $sql = "CREATE TABLE user (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255),
password VARCHAR(255),
role INT(11)
)";
                        db_query($sql);

                        //Create navigation table
                        $sql = "CREATE TABLE navigation (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
parent_id INT(11) NULL,
title TEXT,
url TEXT,
target VARCHAR(255),
position INT(11)
)";
                        db_query($sql);

                        //Insert new user into database.
                        $user = new User();
                        $username = 'admin@admin.com'; //User login
                        $password = $user->encrypt_password('password'); //Encrypt password
                        $role = 1; //Admin role
                        db_query("INSERT INTO user (email, password, role) VALUES ('".$username."', '".$password."', '".$role."');");

                        //Insert default category
                        $category_title = 'Uncategorized';
                        $category_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_title)));
                        $category_description = '<p>Posts that do not fall into other categories.</p>';
                        $category_featured = 'default.jpg';
                        $category_metadescription = METADESCRIPTION;
                        $category_metakeywords = METAKEYWORDS;
                        db_query("INSERT INTO category (title, slug, description, featured, metadescription, metakeywords) VALUES ('".$category_title."', '".$category_slug."', '".$category_description."', '".$category_featured."', '".$category_metadescription."', '".$category_metakeywords."');");

                        //Insert welcome post(s) into database.
                        $post_category_id = 1;
                        $post_title = 'Welcome to GWPRESS!';
                        $post_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post_title)));
                        $post_body = 'Thank you for installing GWPRESS.';
                        $post_featured = 'default.jpg';
                        $post_status = 1;
                        $post_slider = 1;
                        $post_metadescription = METADESCRIPTION;
                        $post_metakeywords = METAKEYWORDS;
                        $post_created_date = date("Y-m-d H:i:s");
                        $post_updated_date = date("Y-m-d H:i:s");
                        db_query("INSERT INTO post (category_id, title, slug, body, featured, status, slider, metadescription, metakeywords, created_date, updated_date) VALUES (".$post_category_id.", '".$post_title."', '".$post_slug."', '".$post_body."', '".$post_featured."', '".$post_status."', '".$post_slider."', '".$post_metadescription."', '".$post_metakeywords."', '".$post_created_date."', '".$post_updated_date."');");

                        //Insert 404 page into database.
                        $page_title = '404 - Page does not exist!';
                        $page_slug = '404';
                        $page_body = '<p>We are sorry but the page you requested does not exist.</p>';
                        $page_featured = 'default.jpg';
                        $page_metadescription = METADESCRIPTION;
                        $page_metakeywords = METAKEYWORDS;
                        db_query("INSERT INTO page (title, slug, body, featured, metadescription, metakeywords) VALUES ('".$page_title."', '".$page_slug."', '".$page_body."', '".$page_featured."', '".$page_metadescription."', '".$page_metakeywords."');");

                        //Insert about page into database.
                        $page_title = 'About';
                        $page_slug = 'about';
                        $page_body = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut augue nec nisi mollis aliquam sed et ex. Nunc rutrum sapien sit amet urna rutrum placerat. Phasellus nunc tortor, luctus at egestas in, pellentesque condimentum ex. Nunc eget orci enim. Quisque eros nunc, rutrum in lacinia non, dictum at urna. Nullam lacinia sem eget ligula dapibus sodales. Vestibulum ut diam sed sapien blandit rutrum vitae eu dui. Phasellus laoreet ante at ipsum ultricies, vitae efficitur libero egestas. Curabitur ac arcu consequat, volutpat leo a, molestie risus. Aliquam vitae maximus dolor. Maecenas iaculis dignissim feugiat. Nam eget neque faucibus, maximus turpis sit amet, molestie ante. Morbi in tellus in libero suscipit mattis. Proin et odio quis orci feugiat maximus. Fusce vitae fringilla est, id tempor dolor. Suspendisse a ornare eros.</p>
<p>Nullam felis massa, sollicitudin vel tempus eu, congue sed urna. Duis a suscipit eros. Nullam dignissim eu erat a tempor. Donec cursus, tellus in porta viverra, metus turpis faucibus tortor, a dapibus dolor ipsum eget tellus. Cras tincidunt lectus nibh, sed facilisis odio aliquam id. Sed ullamcorper, risus in egestas laoreet, dolor risus tincidunt magna, id varius ex sapien vitae risus. Integer tristique nunc non cursus cursus.</p>
<p>Pellentesque a tortor elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam in magna porttitor, convallis nunc non, sollicitudin massa. In sodales pellentesque quam vel pharetra. Praesent gravida semper enim. Nam sit amet turpis vel nunc mollis eleifend ut sit amet est. Vestibulum eget aliquam diam. Nulla in velit id augue gravida condimentum. Mauris sed lorem in risus euismod venenatis nec id nisi. Nullam feugiat consectetur massa nec vulputate.</p>
<p>Nulla ante enim, iaculis in facilisis sed, convallis eu quam. Vestibulum cursus mi in sem blandit sagittis. Proin finibus metus nec urna interdum, id vulputate mi pulvinar. Suspendisse mattis gravida ex ut ornare. Vestibulum dapibus sapien eu magna congue fringilla. Aenean ut lectus ante. Ut mi tellus, condimentum et aliquam in, hendrerit at quam. Ut venenatis arcu turpis, eget mollis tellus laoreet eget. Mauris interdum feugiat quam, quis scelerisque massa finibus vel. Proin sit amet ullamcorper ex.</p>
<p>Sed a diam a lectus venenatis sodales. In hac habitasse platea dictumst. Cras eu sollicitudin odio. Curabitur ultrices luctus ligula, tincidunt interdum erat lobortis nec. Donec eros lacus, aliquet congue laoreet at, ornare at erat. Cras id massa lacinia, pulvinar velit tincidunt, ultricies enim. Aliquam orci purus, mollis a porttitor non, pellentesque et est. Aliquam erat volutpat. Mauris porta odio feugiat, volutpat diam quis, tempus mi. Maecenas dictum ut nunc in tincidunt. Aenean vitae tortor odio. Curabitur iaculis lacus non magna tristique vehicula. Pellentesque quam mi, mollis sed elit viverra, semper maximus urna. Etiam pharetra fermentum laoreet. Sed sit amet elit eget erat ullamcorper gravida at id quam.</p>';
                        $page_featured = 'default.jpg';
                        $page_metadescription = METADESCRIPTION;
                        $page_metakeywords = METAKEYWORDS;
                        db_query("INSERT INTO page (title, slug, body, featured, metadescription, metakeywords) VALUES ('".$page_title."', '".$page_slug."', '".$page_body."', '".$page_featured."', '".$page_metadescription."', '".$page_metakeywords."');");

                        //Insert navigation items into database.
                        db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES (NULL, 'Home', '/', '_self', '0');");
                        db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES (NULL, 'About', '/about', '_self', '1');");
                        db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES (NULL, 'Dropdown', '#', '_self', '2');");
                        db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES (3, 'Dropdown Item', '/', '_self', '3');");
                        db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES (NULL, 'Contact', '/contact', '_self', '4');");
                        db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES (NULL, 'Admin', '/admin', '_self', '5');");

                        //Delete install file for security.
                        $composer = (COMPOSER_ACTIVE == 1 ? COMPOSER_DIR : '');
                        $install_file = BASE_DIR.'/'.$composer.'gw-content/themes/'.SITE_THEME.'/install.php';
                        chmod($install_file, 0777);
                        unlink($install_file);

                        //Make upload directory and copy default image for composer users.
                        if(COMPOSER_ACTIVE == 1) {
                                mkdir("./gw-content", 0777);
                                mkdir("./gw-content/uploads", 0777);
                                copy(BASE_DIR.'/'.$composer.'gw-content/uploads/default.jpg', './gw-content/uploads/default.jpg');
                        }

                        //Flash message and forward to home.
                        $flash = new Flash();
                        $flash->flash('flash_message', 'GWPRESS installed.  Thank you for choosing GWPRESS.');
                        header("Location: ".BASE_URL."");
                }
        }

}