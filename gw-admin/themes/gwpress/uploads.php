<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Uploads</h1>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/admin/uploads/add">New</a>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#CreateFolder">Create Folder</button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteFolder">Delete Folder</button>
    <div id="folder_contents">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Filename</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $dir = './gw-content/uploads';
            $scan_dir = scandir($dir);
            $files = array_diff($scan_dir, array('.', '..', 'Thumbs.db'));
            if(!empty($_GET['folder'])) { $folder = $_GET['folder']; } else { $folder = ''; } ;

            foreach ($files as $file) {
                $file_parts = pathinfo($dir.'/'.$file);
                if(empty($file_parts['extension'])) {
                    echo '<tr>';
                    $next_folder = $folder.$file;
                    echo '<td><button type="button" class="btn btn-info btn-sm pull-left" id="folder_'.$file.'" value="'.$next_folder.'">'.$file.'</button></td>';
                    echo '<script type="text/javascript">
            $(document).ready(function () {
            $("#folder_'.$file.'").click(function(){
            $.ajax({
                type: "GET",
                url: "/admin/uploads/loadfolder",
                data: "folder="+$("#folder_'.$file.'").val(),
                success: function(html) {
                    $("#folder_contents").html(html);

                }
            });

        });
    });
</script>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    $file_dir = $folder . '/' . $file;
                    echo '<td class="actions"><form name="delete_folder_' . $file . '" method="GET" action="/admin/uploads/deletefolder?folder=' . $file_dir . '"><input type="hidden" id="folder" name="folder" value="' . $file_dir . '" /><input type="submit" class="btn btn-danger delete" value="Delete"  onclick="return confirm(\'Are you sure you want to delete that folder (contents must be empty!)?\');"></form></td>';
                    echo '</tr>';
                }
            }

            $i=0;
            foreach ($files as $file) {
                $file_parts = pathinfo($dir . '/' . $file);
                if (!empty($file_parts['extension'])) {
                    {
                        $i++;
                        $file_info = list($width, $height, $type, $attr) = getimagesize(UPLOAD_DIR.$folder.'/'.$file);
                        echo '<tr>';
                        echo '<td><a data-toggle="modal" data-target="#PreviewFile'.$i.'">'.$file.'</a></td>';
                        echo '<td>&nbsp;</td>';
                        echo '<td>&nbsp;</td>';
                        echo '<td>&nbsp;</td>';
                        $file_dir = $folder . '/' . $file;
                        echo '<td class="actions"><form name="delete_' . $file . '" method="GET" action="/admin/uploads/deletefile?file=' . $file_dir . '"><input type="hidden" id="file" name="file" value="' . $file_dir . '" /><input type="submit" class="btn btn-danger delete" value="Delete"  onclick="return confirm(\'Are you sure you want to delete that file?\');"></form></td>';
                        echo '</tr>';
                    }
                }
                //Image preview
                echo '<div id="PreviewFile'.$i.'" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Image Preview: '.$file.'</h4>
                </div>
                <div class="modal-body">';
            if($file_parts['extension'] == 'jpg' OR $file_parts['extension'] == 'gif' OR $file_parts['extension'] == 'png') {
                echo '<img data-toggle="modal" class="upload_image_shrink_preview" src="'.BASE_URL.'/gw-content/uploads/'.$file_dir.'" alt="View: '.$file.'" title="View: '.$file.'">';
                echo '<label for="dimensions" class="control-label">Dimensions:</label>';
                echo '<input class="form-control" type="text" value="'.$file_info[0].'x'.$file_info[1].'">';
                echo '<br />';
            }
                echo '<label for="url" class="control-label">URL:</label>
                    <input class="form-control" type="text" onfocus="this.select();" onmouseup="return false;" value="'.BASE_URL.'/gw-content/uploads/'.$file.'"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>';
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>

    <!--Create folder modal-->
    <div id="CreateFolder" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Folder</h4>
                </div>
                <div class="modal-body">
                    <form id="create_folder" class="form-horizontal" accept-charset="utf-8" method="get" action="<?php echo BASE_URL; ?>/admin/uploads/folder">
                        <div class="form-group">
                            <label for="folder" class="col-sm-2 control-label">File</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="folder" name="folder" placeholder="Folder" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!--Delete folder modal-->
    <div id="DeleteFolder" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Folder</h4>
                </div>
                <div class="modal-body">
                    <form id="delete_folder" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo BASE_URL; ?>/admin/uploads/directory">
                        <div class="form-group">
                            <label for="folder" class="col-sm-2 control-label">File</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="folder" name="folder" placeholder="Folder" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" id="submit" name="submit" class="delete btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>