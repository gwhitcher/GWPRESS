<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Uploads</h1>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo BASE_URL; ?>/admin/uploads/upload_file">

        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">File</label>
            <div class="col-sm-10">
                <span class="btn btn-default btn-file">
                Choose a file...<input type="file" id="file_upload" name="file_upload" placeholder="File" required>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">Directory</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="directory" name="directory" placeholder="Directory">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>