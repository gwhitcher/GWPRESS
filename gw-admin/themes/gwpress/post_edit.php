<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
$info = new Post();
$post = $info->post_load($id);
if(!empty($_POST)) {
    $category_id_post = $_POST['category_id'];
    $category_id = implode(",", $category_id_post);
    $title = $_POST['title'];
    $body = $_POST['body'];
    $featured = $_POST['featured'];
    $status = $_POST['status'];
    $slider = $_POST['slider'];
    $metadescription = $_POST['metadescription'];
    $metakeywords = $_POST['metakeywords'];
    $info->post_save($id, ''.$category_id.'', ''.$title.'', ''.$body.'', ''.$featured.'', ''.$status.'', ''.$slider.'', ''.$metadescription.'', ''.$metakeywords.'');
}
$categories = db_select("SELECT * FROM category");
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Post: <?php echo $post['title'];?></h1>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/posts/edit?id=<?php echo $id;?>">

        <div class="form-group">
            <label for="category_id" class="col-sm-2 control-label">Category ID</label>
            <div class="col-sm-10">
                <select name="category_id[]" id="category_id" class="form-control" required multiple>
                    <?php foreach ($categories as $category) { ?>
                        <?php
                        echo '<option ';
                        $post_categories = $post['category_id'];
                        $category_ids = explode(',',$post_categories);
                        if (in_array($category['id'], $category_ids)) {
                            echo 'selected="selected"';
                        }
                        echo 'value="'.$category['id'].'">';
                        echo $category['title'];
                        echo '</option>';
                        ?>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $post['title'];?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">Body</label>
            <div class="col-sm-10">
                <textarea id="body" name="body" class="form-control" rows="3" placeholder="Body" required><?php echo $post['body'];?></textarea>
                <a class="btn btn-info" href="javascript:;" onclick="unloadTiny();"><span>Remove TinyMCE</span></a>
            </div>
        </div>

        <div class="form-group">
            <label for="featured" class="col-sm-2 control-label">Featured Image</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="featured" name="featured" placeholder="Featured Image" value="<?php echo $post['featured'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="status" id="status">
                    <option <?php if($post['status'] == 0) echo 'selected="selected"'; ?> value="0">Draft</option>
                    <option <?php if($post['status'] == 1) echo 'selected="selected"'; ?> value="1">Published</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="slider" class="col-sm-2 control-label">Slider</label>
            <div class="col-sm-10">
                <select class="form-control" name="slider" id="slider">
                    <option <?php if($post['slider'] == 0) echo 'selected="selected"'; ?> value="0">No</option>
                    <option <?php if($post['slider'] == 1) echo 'selected="selected"'; ?> value="1">Yes</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="metadescription" class="col-sm-2 control-label">Meta Description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="Meta Description" value="<?php echo $post['metadescription'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="metakeywords" class="col-sm-2 control-label">Meta Keywords</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="metakeywords" name="metakeywords" placeholder="Meta Keywords" value="<?php echo $post['metakeywords'];?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>
