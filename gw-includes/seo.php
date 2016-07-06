<?php
class SEO {

    public function __construct() {
    }

    public static function title() {
        $routing_uri = $_SERVER['REQUEST_URI'];

        /* Contact */
        if(strpos($routing_uri,'/contact') !== FALSE) {
            echo '<title>Contact - '.SITE_TITLE.'</title>';
        }

        /* Blog */
        elseif(strpos($routing_uri,'/category') !== FALSE) {
            $category_id = explode("/", $routing_uri);
            if(is_numeric($category_id[2])) {
                $id = mysqli_real_escape_string(db_connect(), $category_id[2]);
            } else {
                $id = mysqli_real_escape_string(db_connect(), $category_id[3]);
            }
            $category_lookup = new Category();
            $category = $category_lookup->category_load($id);
            echo '<title>'.$category['title'].' - '.SITE_TITLE.'</title>';
        }

        elseif(strpos($routing_uri,'/blog') !== FALSE) {
            $post_id = explode("/", $routing_uri);
            if(is_numeric($post_id[1])) {
                $id = mysqli_real_escape_string(db_connect(), $post_id[1]);
            } else {
                $id = mysqli_real_escape_string(db_connect(), $post_id[2]);
            }
            $post_class = new Post();
            $post = $post_class->post_load($id);
            echo '<title>'.$post['title'].' - '.SITE_TITLE.'</title>';
        }

        /* Pagination for homepage */
        elseif(strpos($routing_uri,'/index.php') !== FALSE) {
            echo '<title>'.SITE_TITLE.' - '.SITE_HEADLINE.'</title>';
        }

        /* Home and Pages Routes needs to be at end or else will overwrite other routes. */
        elseif(strpos($routing_uri,'/') !== FALSE) {
            $page = explode("/", $routing_uri);
            if(empty($page[1])) {
                echo '<title>'.SITE_TITLE.' - '.SITE_HEADLINE.'</title>';
            } elseif (is_numeric($page[1])) {
                $id = mysqli_real_escape_string(db_connect(), $page[1]);
                $post_class = new Post();
                $post = $post_class->post_load($id);
                echo '<title>'.$post['title'].' - '.SITE_TITLE.'</title>';
            }
            else {
                $slug = mysqli_real_escape_string(db_connect(), $page[1]);
                $slug = strtok($slug, '?');
                $page_lookup = new Page();
                $page = $page_lookup->page_load_slug($slug);
                if(empty($page['title'])) { $page['title'] = SITE_HEADLINE; }
                echo '<title>'.$page['title'].' - '.SITE_TITLE.'</title>';
            }
        }

        /* If no route show 404 */
        else {
            echo '<title>'.SITE_TITLE.' - 404 Page not found!</title>';
        }
    }

    public static function metainfo() {
        $routing_uri = $_SERVER['REQUEST_URI'];

        /* Contact */
        if(strpos($routing_uri,'/contact') !== FALSE) {
            echo '<meta name="description" content="'.METADESCRIPTION.'">';
            echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
        }

        /* Blog */
        elseif(strpos($routing_uri,'/category') !== FALSE) {
            $category_id = explode("/", $routing_uri);
            if(is_numeric($category_id[2])) {
                $id = mysqli_real_escape_string(db_connect(), $category_id[2]);
            } else {
                $id = mysqli_real_escape_string(db_connect(), $category_id[3]);
            }
            $category_lookup = new Category();
            $category = $category_lookup->category_load($id);
            if(!empty($category['metadescription'])) {
                echo '<meta name="description" content="'.$category['metadescription'].'">';
            } else {
                echo '<meta name="description" content="'.METADESCRIPTION.'">';
            }
            if(!empty($category['metakeywords'])) {
                echo '<meta name="keywords" content="'.$category['metakeywords'].'">';
            } else {
                echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
            }
        }

        elseif(strpos($routing_uri,'/blog') !== FALSE) {
            $post_id = explode("/", $routing_uri);
            $id = mysqli_real_escape_string(db_connect(), $post_id[2]);
            $post_class = new Post();
            $post = $post_class->post_load($id);
            if(!empty($post['metadescription'])) {
                echo '<meta name="description" content="'.$post['metadescription'].'">';
            } else {
                echo '<meta name="description" content="'.METADESCRIPTION.'">';
            }
            if(!empty($post['metakeywords'])) {
                echo '<meta name="keywords" content="'.$post['metakeywords'].'">';
            } else {
                echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
            }
        }

        /* Pagination for homepage */
        elseif(strpos($routing_uri,'/index.php') !== FALSE) {
            echo '<meta name="description" content="'.METADESCRIPTION.'">';
            echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
        }

        /* Home and Pages Routes needs to be at end or else will overwrite other routes. */
        elseif(strpos($routing_uri,'/') !== FALSE) {
            $page = explode("/", $routing_uri);
            if(empty($page[1])) {
                echo '<meta name="description" content="'.METADESCRIPTION.'">';
                echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
            } else {
                $page_slug = explode("/", $routing_uri);
                $slug = mysqli_real_escape_string(db_connect(), $page_slug[1]);
                $slug = strtok($slug, '?');
                $page_lookup = new Page();
                $page = $page_lookup->page_load_slug($slug);
                if(!empty($page['metadescription'])) {
                    echo '<meta name="description" content="'.$page['metadescription'].'">';
                } else {
                    echo '<meta name="description" content="'.METADESCRIPTION.'">';
                }
                if(!empty($page['metakeywords'])) {
                    echo '<meta name="keywords" content="'.$page['metakeywords'].'">';
                } else {
                    echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
                }
            }
        }

        /* If no route show 404 */
        else {
            echo '<meta name="description" content="'.METADESCRIPTION.'">';
            echo '<meta name="keywords" content="'.METAKEYWORDS.'">';
        }
    }
}