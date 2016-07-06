<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Navigation <small>(drag and drop to reorder)</small></h1>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/admin/navigation/add">New</a>
    <ul id="my-list">
        <li class="row">
            <div class="col-md-3 column_head">ID</div>
            <div class="col-md-3 column_head">NAME</div>
            <div class="col-md-3 column_head">EDIT</div>
            <div class="col-md-3 column_head">DELETE</div>
        </li>
        <?php
        $nav_items = db_query("SELECT * FROM navigation ORDER BY position ASC");
        $i=0;
        foreach($nav_items as $nav_item) {
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' alt_row';
            } ?>
            <li class="row<?php echo $class; ?>" id="item_<?php echo $nav_item['id']; ?>">
                <div class="col-md-3">
                    <?php echo $nav_item['id']; ?>
                </div>
                <div class="col-md-3">
                    <?php echo $nav_item['title']; ?>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-warning" href="<?php echo BASE_URL;?>/admin/navigation/edit?id=<?php echo $nav_item['id'];?>">Edit</a>
                </div>
                <div class="col-md-3">
                    <a class="delete btn btn-danger" href="<?php echo BASE_URL;?>/admin/navigation/delete?id=<?php echo $nav_item['id']; ?>">Delete</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('ul').sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                var success = alert("Order Saved");

                // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    success: success,
                    url: '<?php echo BASE_URL;?>/admin/navigation_reorder'
                });

            }
        });
    });
</script>