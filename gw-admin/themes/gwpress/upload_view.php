<?php
$id = mysqli_real_escape_string(db_connect(), $_GET['id']);
$info = new Upload();
$upload = $info->upload_view($id);
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Upload: <?php echo $upload['filename']; ?></h1>
    <?php
    echo '<img data-toggle="modal" data-target="#PreviewImage'.$upload['id'].'" class="upload_image_shrink" src="'.BASE_URL.'/gw-content/uploads/'.$upload['filepath'].$upload['filename'].'" alt="View: '.$upload['filename'].'" title="View: '.$upload['filename'].'">';
    echo '<br />';
    echo '<a class="delete btn btn-danger" href="'.BASE_URL.'/admin/uploads/delete?id='.$upload['id'].'">Delete</a>';

    //Image preview
    echo '<div id="PreviewImage" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Image Preview: '.$upload['filename'].'</h4>
                </div>
                <div class="modal-body">
                    <img data-toggle="modal" class="upload_image_shrink_preview" src="'.BASE_URL.'/gw-content/uploads/'.$upload['filepath'].$upload['filename'].'" alt="View: '.$upload['filename'].'" title="View: '.$upload['filename'].'">
                    <br />
                    <label for="url" class="control-label">URL:</label>
                    <input class="form-control" type="text" onfocus="this.select();" onmouseup="return false;" value="'.BASE_URL.'/gw-content/uploads/'.$upload['filepath'].$upload['filename'].'"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>';
    ?>
</div>