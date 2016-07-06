<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
$info = new Navigation();
$navigation = $info->navigation_load($id);
if(!empty($_POST)) {
    $parent_id = $_POST['parent_id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $target = $_POST['target'];
    $position = $_POST['position'];
    $info->navigation_save($id, ''.$parent_id.'', ''.$title.'', ''.$url.'', ''.$target.'', ''.$position.'');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Navigation Item: <?php echo $navigation['title'];?></h1>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/navigation/edit?id=<?php echo $id;?>">

        <div class="form-group">
            <label for="parent_id" class="col-sm-2 control-label">Parent ID (leave blank if top level)</label>
            <div class="col-sm-10">
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">(blank)</option>
                    <?php
                    $navigation_items = db_query("SELECT * FROM navigation");
                    foreach($navigation_items as $nav_item) {
                        if($navigation['parent_id'] == $nav_item['id']) {
                            echo '<option selected="selected" value="'.$nav_item['id'].'">'.$nav_item['title'].'</option>';
                        } else {
                            echo '<option value="'.$nav_item['id'].'">'.$nav_item['title'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $navigation['title'];?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="url" class="col-sm-2 control-label">URL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="<?php echo $navigation['url'];?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="target" class="col-sm-2 control-label">Target</label>
            <div class="col-sm-10">
                <select class="form-control" id="target" name="target">
                    <option <?php if($navigation['target'] === '_self') { echo 'selected="selected"'; } ?> value="_self">_self</option>
                    <option <?php if($navigation['target'] === '_blank') { echo 'selected="selected"'; } ?>value="_blank">_blank</option>
                    <option <?php if($navigation['target'] === 'new') { echo 'selected="selected"'; } ?>value="new">new</option>
                    <option <?php if($navigation['target'] === '_parent') { echo 'selected="selected"'; } ?>value="_parent">_parent</option>
                    <option <?php if($navigation['target'] === '_top') { echo 'selected="selected"'; } ?>value="_top">_top</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>