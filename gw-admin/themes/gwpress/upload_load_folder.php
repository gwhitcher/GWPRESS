<div class="table-responsive">
    <table class="table table-striped">
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
        if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = ''; };

        echo '<tr>';
        $back_folder = $folder;
        $back_folder_clean = substr(strrchr($back_folder,'/'), 1);
        $back_folder = substr($back_folder, 0, - strlen($back_folder_clean));
        if(empty($back_folder)) { $back_folder = ''; };
        echo '<td><button type="button" class="btn btn-info btn-sm pull-left" id="folder_back" value="'.$back_folder.'">...</button></td>';
        echo '<script type="text/javascript">
            $(document).ready(function () {
            $("#folder_back").click(function(){
            $.ajax({
                type: "GET",
                url: "/admin/uploads/loadfolder",
                data: "folder="+$("#folder_back").val(),
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
        echo '<td>&nbsp;</td>';
        echo '</tr>';

        $dir = './gw-content/uploads/'.$folder;
        $scan_dir = scandir($dir);
        $files = array_diff($scan_dir, array('.', '..', 'Thumbs.db'));

        foreach ($files as $file) {
            $file_parts = pathinfo($dir.'/'.$file);
            if(empty($file_parts['extension'])) {
                echo '<tr>';
                $next_folder = $folder.'/'.$file;
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
                echo '<td class="actions"><form name="delete_' . $file . '" method="GET" action="/admin/uploads/deletefolder?folder=' . $file_dir . '"><input type="hidden" id="folder" name="folder" value="' . $file_dir . '" /><input type="submit" class="btn btn-danger delete" value="Delete"  onclick="return confirm(\'Are you sure you want to delete that folder (contents must be empty!)?\');"></form></td>';
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
                    <input class="form-control" type="text" onfocus="this.select();" onmouseup="return false;" value="'.BASE_URL.'/gw-content/uploads/'.$file_dir.'"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>';
                }
            }
        }
        ?>
        </tbody>
    </table>
</div>