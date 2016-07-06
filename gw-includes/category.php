<?php
class Category {

    public function __construct() {
    }

    public static function category_load($id) {
        if(empty($id)) {
            $category = array();
            $flash = new Flash();
            $flash->flash('flash_message', 'Category does not exist!', 'warning');
            header("Location: ".BASE_URL.'/404');
        } else {
            $category = db_select_row("SELECT * FROM category where id ='".$id."'");
            if(empty($category)) {
                $flash = new Flash();
                $flash->flash('flash_message', 'Category does not exist!', 'warning');
                header("Location: ".BASE_URL.'/404');
            }
        }
        return $category;
    }

    public static function category_save($id, $title, $description, $featured, $metadescription, $metakeywords) {
        $category_title = mysqli_real_escape_string(db_connect(), $title);
        $category_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_title)));
        $category_description = mysqli_real_escape_string(db_connect(), $description);
        $category_featured = mysqli_real_escape_string(db_connect(), $featured);
        $category_metadescription = mysqli_real_escape_string(db_connect(), $metadescription);
        $category_metakeywords = mysqli_real_escape_string(db_connect(), $metakeywords);
        if(empty($id)) {
            db_query("INSERT INTO category (title, slug, description, featured, metadescription, metakeywords) VALUES ('".$category_title."', '".$category_slug."', '".$category_description."', '".$category_featured."', '".$category_metadescription."', '".$category_metakeywords."');");
            $flash = new Flash();
            $flash->flash('flash_message', 'Category created!');
            header("Location: ".BASE_URL.'/admin/categories/');
        } else {
            db_query("UPDATE ".MYSQL_DB.".category SET title = '".$category_title."', slug = '".$category_slug."', description = '".$category_description."', featured = '".$category_featured."', metadescription = '".$category_metadescription."', metakeywords = '".$category_metakeywords."' WHERE id = ".$id.";");
            $flash = new Flash();
            $flash->flash('flash_message', 'Category updated!');
            header("Location: ".BASE_URL.'/admin/categories/');
        }
    }

    public static function category_delete($id) {
        if(empty($id)) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Category does not exist!', 'warning');
            header("Location: ".BASE_URL.'/admin/categories/');
        } else {
            db_query("DELETE FROM category WHERE id = ".$id);
            $flash = new Flash();
            $flash->flash('flash_message', 'Category deleted!');
            header("Location: ".BASE_URL.'/admin/categories/');
        }
    }

    public static function category_id_search($string = '', $id = '') {
        $string_id = explode(',',$string);
        if (in_array($id, $string_id))
            return $id;
        else
            return $id;
    }
}