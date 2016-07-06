<?php

class Paginator {

    public static function pagination($limit = '', $table = '', $condition = '') {
        $limit_sql = mysqli_real_escape_string(db_connect(), $limit);
        $table_sql = mysqli_real_escape_string(db_connect(), $table);
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page=1;
        };
        $start_from = ($page-1) * $limit;

        $pagination_results = db_select("SELECT * FROM ".$table_sql.$condition." ORDER BY id DESC LIMIT $start_from, $limit_sql");
        return $pagination_results;
    }

    public static function pagination_links($limit = '', $table = '', $condition = '') {
        $sql = "SELECT COUNT(id) FROM ".$table."".$condition."";
        $rs_result = mysqli_query(db_connect(), $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);

        echo '<nav><ul class="pagination"><li class="disabled">
        <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        </a>
        </li>';

        for ($i=1; $i<=$total_pages; $i++) {
            echo "<li><a href='index.php?page=".$i."'>".$i."</a></li>";
        };

        echo '<li class="disabled">
        <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>';
    }

}