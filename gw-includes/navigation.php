<?php
class Navigation {

    public function __construct() {
    }

    public static function navigation_load($id) {
        if(empty($id)) {
            $navigation = array();
            $flash = new Flash();
            $flash->flash('flash_message', 'Navigation item does not exist!', 'warning');
            header("Location: ".BASE_URL.'/404');
        } else {
            $navigation = db_select_row("SELECT * FROM navigation where id ='".$id."'");
            if(empty($navigation)) {
                $flash = new Flash();
                $flash->flash('flash_message', 'Navigation item does not exist!', 'warning');
                header("Location: ".BASE_URL.'/404');
            }
        }
        return $navigation;
    }

    public static function navigation_save($id, $parent_id, $title, $url, $target, $position) {
        $nav_parent_id = mysqli_real_escape_string(db_connect(), $parent_id);
        $nav_title = mysqli_real_escape_string(db_connect(), $title);
        $nav_url = mysqli_real_escape_string(db_connect(), $url);
        $nav_target = mysqli_real_escape_string(db_connect(), $target);
        $nav_position = mysqli_real_escape_string(db_connect(), $position);
        if(empty($id)) {
            db_query("INSERT INTO navigation (parent_id, title, url, target, position) VALUES ('".$nav_parent_id."', '".$nav_title."', '".$nav_url."', '".$nav_target."', '".$nav_position."');");
            $flash = new Flash();
            $flash->flash('flash_message', 'Navigation item added!');
            header("Location: ".BASE_URL.'/admin/navigation/');
        } else {
            db_query("UPDATE ".MYSQL_DB.".navigation SET parent_id = '".$nav_parent_id."', title = '".$nav_title."', url = '".$nav_url."', target = '".$nav_target."', position = '".$nav_position."' WHERE id = ".$id.";");
            $flash = new Flash();
            $flash->flash('flash_message', 'Navigation item updated!');
            header("Location: ".BASE_URL.'/admin/navigation/');
        }
    }

    public static function navigation_delete($id) {
        if(empty($id)) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Navigation item does not exist!', 'warning');
            header("Location: ".BASE_URL.'/admin/navigation/');
        } else {
            db_query("DELETE FROM navigation WHERE id = ".$id);
            $flash = new Flash();
            $flash->flash('flash_message', 'Navigation item deleted!');
            header("Location: ".BASE_URL.'/admin/navigation/');
        }
    }
}