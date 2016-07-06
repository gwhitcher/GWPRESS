<?php
class Page {

    public function __construct() {
    }

    public static function page_load_slug($slug) {
        $page = db_select_row("SELECT * FROM page where slug ='".$slug."'");
        return $page;
    }

    public static function page_load_id($id) {
        if(empty($id)) {
            $page = array();
            $flash = new Flash();
            $flash->flash('flash_message', 'Page does not exist!', 'warning');
            header("Location: ".BASE_URL);
        } else {
            $page = db_select_row("SELECT * FROM page WHERE id = ".$id);
            if(empty($page)) {
                $flash = new Flash();
                $flash->flash('flash_message', 'Page does not exist!', 'warning');
                header("Location: ".BASE_URL);
            }
        }
        return $page;
    }

    public static function page_save($id, $title, $body, $featured, $metadescription, $metakeywords) {
        $page_title = mysqli_real_escape_string(db_connect(), $title);
        $page_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $page_title)));
        $page_body = mysqli_real_escape_string(db_connect(), $body);
        $page_featured = mysqli_real_escape_string(db_connect(), $featured);
        $page_metadescription = mysqli_real_escape_string(db_connect(), $metadescription);
        $page_metakeywords = mysqli_real_escape_string(db_connect(), $metakeywords);
        if(empty($id)) {
            db_query("INSERT INTO page (title, slug, body, featured, metadescription, metakeywords) VALUES ('".$page_title."', '".$page_slug."', '".$page_body."', '".$page_featured."', '".$page_metadescription."', '".$page_metakeywords."');");
            $flash = new Flash();
            $flash->flash('flash_message', 'Page created!');
            header("Location: ".BASE_URL.'/admin/pages/');
        } else {
            db_query("UPDATE ".MYSQL_DB.".page SET title = '".$page_title."', slug = '".$page_slug."', body = '".$page_body."', featured = '".$page_featured."', metadescription = '".$page_metadescription."', metakeywords = '".$page_metakeywords."' WHERE id = ".$id.";");
            $flash = new Flash();
            $flash->flash('flash_message', 'Page updated!');
            header("Location: ".BASE_URL.'/admin/pages/');
        }
    }

    public static function page_delete($id) {
        if(empty($id)) {
            header("Location: ".BASE_URL.'/admin/pages');
        } else {
            db_query("DELETE FROM page WHERE id = ".$id);
            $flash = new Flash();
            $flash->flash('flash_message', 'Page deleted!');
            header("Location: ".BASE_URL.'/admin/pages/');
        }
    }
}