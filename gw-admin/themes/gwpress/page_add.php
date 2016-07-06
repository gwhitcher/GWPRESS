<?php
if(!empty($_POST)) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $featured = $_POST['featured'];
    $metadescription = $_POST['metadescription'];
    $metakeywords = $_POST['metakeywords'];
    $page_class = new Page();
    $page_class->page_save('', ''.$title.'', ''.$body.'', ''.$featured.'', ''.$metadescription.'', ''.$metakeywords.'');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Pages</h1>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/pages/add">

        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
            </div>
        </div>

        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">Body</label>
            <div class="col-sm-10">
                <textarea id="body" name="body" class="form-control" rows="3" placeholder="Body"></textarea>
                <a class="btn btn-info" href="javascript:;" onclick="unloadTiny();"><span>Remove TinyMCE</span></a>
            </div>
        </div>

        <div class="form-group">
            <label for="featured" class="col-sm-2 control-label">Featured Image</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="featured" name="featured" placeholder="Featured Image">
            </div>
        </div>

        <div class="form-group">
            <label for="metadescription" class="col-sm-2 control-label">Meta Description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="Meta Description">
            </div>
        </div>

        <div class="form-group">
            <label for="metakeywords" class="col-sm-2 control-label">Meta Keywords</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="metakeywords" name="metakeywords" placeholder="Meta Keywords">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>