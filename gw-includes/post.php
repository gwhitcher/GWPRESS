<?php
class Post {

    public function __construct() {
    }

    public static function post_load($id) {
        if(empty($id)) {
            $post = array();
            $flash = new Flash();
            $flash->flash('flash_message', 'Post does not exist!', 'warning');
            header("Location: ".BASE_URL);
        } else {
            $post = db_select_row("SELECT * FROM post WHERE id = ".$id);
            if(empty($post)) {
                $flash = new Flash();
                $flash->flash('flash_message', 'Post does not exist!', 'warning');
                header("Location: ".BASE_URL);
            }
        }
        return $post;
    }

    public static function post_save($id, $category_id, $title, $body, $featured, $status, $slider, $metadescription, $metakeywords) {
        $post_category_id = mysqli_real_escape_string(db_connect(), $category_id);
        $post_title = mysqli_real_escape_string(db_connect(), $title);
        $post_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post_title)));
        $post_body = mysqli_real_escape_string(db_connect(), $body);
        $post_featured = mysqli_real_escape_string(db_connect(), $featured);
        $post_status = mysqli_real_escape_string(db_connect(), $status);
        $post_slider = mysqli_real_escape_string(db_connect(), $slider);
        $post_metadescription = mysqli_real_escape_string(db_connect(), $metadescription);
        $post_metakeywords = mysqli_real_escape_string(db_connect(), $metakeywords);
        $post_created_date = date("Y-m-d H:i:s");
        $post_updated_date = date("Y-m-d H:i:s");
        if(empty($id)) {
            db_query("INSERT INTO post (category_id, title, slug, body, featured, status, slider, metadescription, metakeywords, created_date, updated_date) VALUES ('".$post_category_id."', '".$post_title."', '".$post_slug."', '".$post_body."', '".$post_featured."', '".$post_status."', '".$post_slider."', '".$post_metadescription."', '".$post_metakeywords."', '".$post_created_date."', '".$post_updated_date."');");
            $flash = new Flash();
            $flash->flash('flash_message', 'Post created!');
            header("Location: ".BASE_URL.'/admin/posts/');
        } else {
            db_query("UPDATE ".MYSQL_DB.".post SET category_id = '".$post_category_id."', title = '".$post_title."', slug = '".$post_slug."', body = '".$post_body."', featured = '".$post_featured."', status = '".$post_status."', slider = '".$post_slider."', metadescription = '".$post_metadescription."', metakeywords = '".$post_metakeywords."', updated_date = '".$post_updated_date."' WHERE id = ".$id.";");
            $flash = new Flash();
            $flash->flash('flash_message', 'Post updated!');
            header("Location: ".BASE_URL.'/admin/posts/');
        }
    }

    public static function post_delete($id) {
        if(empty($id)) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Post does not exist!', 'warning');
            header("Location: ".BASE_URL.'/admin/posts/');
        } else {
            db_query("DELETE FROM post WHERE id = ".$id);
            $flash = new Flash();
            $flash->flash('flash_message', 'Post deleted!');
            header("Location: ".BASE_URL.'/admin/posts/');
        }
    }

    public static function read_more($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
            $text = strip_tags($text);
            $text = "<p class='readmore'>".$text."</p>";
        } else {
            $text = "<p class='readmore'>".$text."</p>";
        }
        return $text;
    }

}