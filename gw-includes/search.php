<?php
class Search {

    public function __construct() {
    }

    public static function search_query($keyword = '', $category = '') {
        if(isset($_GET)) {
            $keyword_clean = mysqli_real_escape_string(db_connect(), $keyword);
            $category_clean = mysqli_real_escape_string(db_connect(), $category);

            if($category_clean ===  'post') {
                $search_results = db_select("SELECT * FROM post WHERE title LIKE '%".$keyword_clean."%' OR body LIKE '%".$keyword_clean."%'");
            } elseif($category_clean ===  'category') {
                $search_results = db_select("SELECT * FROM category WHERE title LIKE '%".$keyword_clean."%' OR description LIKE '%".$keyword_clean."%'");
            } elseif($category_clean ===  'page') {
                $search_results = db_select("SELECT * FROM page WHERE title LIKE '%".$keyword_clean."%' OR body LIKE '%".$keyword_clean."%'");
            } elseif($category_clean ===  'upload') {
                $search_results = db_select("SELECT * FROM upload WHERE filename LIKE '%".$keyword_clean."%' OR filetype LIKE '%".$keyword_clean."%' OR filepath LIKE '%".$keyword_clean."%'");
            } elseif($category_clean ===  'user') {
                $search_results = db_select("SELECT * FROM user WHERE username LIKE '%".$keyword_clean."%'");
            } else { // ALL
                $search = new Search();
                $search_results = $search->searchAllDB($keyword_clean);
                //print_r($search_results);
            }
        } else {
            $search_results = '';
            $flash = new Flash();
            $flash->flash('flash_message', 'No keyword entered!', 'danger');
        }
        return $search_results;
    }

    public function searchAllDB($search){
        $out = '';
        $sql = "show tables";
        $rs = db_query($sql);
        if($rs->num_rows > 0){
            while($r = $rs->fetch_array()){
                $table = $r[0];
                $sql_search = "select * from ".$table." where ";
                $sql_search_fields = Array();
                $sql2 = "SHOW COLUMNS FROM ".$table;
                $rs2 = db_query($sql2);
                if($rs2->num_rows > 0){
                    while($r2 = $rs2->fetch_array()){
                        $colum = $r2[0];
                        $sql_search_fields[] = $colum." like('%".$search."%')";
                    }
                    $rs2->close();
                }
                $sql_search .= implode(" OR ", $sql_search_fields);
                $results = db_select($sql_search);
                foreach($results as $result) {
                    if(!empty($result['description'])) {
                        $out .= '<li>Category: <a href="'.BASE_URL.'/admin/categories/edit?id='.$result['id'].'">'.$result['title'].'</a></li>';
                    } elseif(!empty($result['category_id'])) {
                        $out .= '<li>Post: <a href="'.BASE_URL.'/admin/posts/edit?id='.$result['id'].'">'.$result['title'].'</a></li>';
                    } elseif(!empty($result['filename'])) {
                        $out .= '<li>Upload: <a href="'.BASE_URL.'/admin/uploads/view?id='.$result['id'].'">'.$result['filename'].'</a></li>';
                    } elseif(!empty($result['username'])) {
                        $out .= '<li>User: <a href="'.BASE_URL.'/admin/users/edit?id='.$result['id'].'">'.$result['username'].'</a></li>';
                    } elseif(!empty($result['body'])) {
                        $out .= '<li>Page: <a href="'.BASE_URL.'/admin/pages/edit?id='.$result['id'].'">'.$result['title'].'</a></li>';
                    }
                }
            }
            $rs->close();
        }
        return $out;
    }

}