<?php
class Upload {

    public function __construct() {

    }

    public function upload($file, $directory) {
        $target_dir = UPLOAD_DIR.$directory;

        //Make directory if it does not exist.
        if(!file_exists($target_dir)) {
            mkdir($target_dir, 0777);
        }

        $target_file = $target_dir.basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = '';
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1; //No errors
            } else {
                $uploadOk = 0; //Error flag
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Sorry, your file was not uploaded.  It already exists.', 'danger');
            $uploadOk = 0; //Error flag
        }

        // Check file size
        if ($file["size"] > $this->return_bytes(ini_get('upload_max_filesize'))) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Sorry, your file was not uploaded.  It is too large', 'danger');
            header("Location: ".BASE_URL.'/admin/uploads/add');
            $uploadOk = 0; //Error flag
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Sorry, your file was not uploaded.  Only JPG, PNG, JPEG, and GIF files are allowed.', 'danger');
            header("Location: ".BASE_URL.'/admin/uploads/add');
            $uploadOk = 0; //Error flag
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $flash = new Flash();
            $flash->flash('flash_message', 'Sorry, your file was not uploaded.', 'danger');
            header("Location: ".BASE_URL.'/admin/uploads/add');


        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $flash = new Flash();
                $flash->flash('flash_message', 'File uploaded!');
                header("Location: ".BASE_URL.'/admin/uploads/');
            } else {
                $flash = new Flash();
                $flash->flash('flash_message', 'Sorry, there was an error uploading your file.', 'warning');
                header("Location: ".BASE_URL.'/admin/uploads/add');
            }
        }
    }

    public function create_folder($folder) {
        $upload_dir = UPLOAD_DIR;
        if (substr($folder, -1) == '/') {
            mkdir($upload_dir.$folder, 0777);
        } else {
            $folder_fixed = ''.$folder.'/';
            mkdir($upload_dir.$folder_fixed, 0777);
        }
        $flash = new Flash();
        $flash->flash('flash_message', 'Folder created!');
        header("Location: ".BASE_URL.'/admin/uploads/');
    }

    public function delete_file($file) {
        $flash = new Flash();
        if (!unlink(UPLOAD_DIR.$file)) {
            $flash->flash('flash_message', 'Error deleting '.$file.'!', 'danger');
            header("Location: ".BASE_URL.'/admin/uploads/');
        }
        else {
            $flash->flash('flash_message', 'File: '.$file.' deleted!');
            header("Location: ".BASE_URL.'/admin/uploads/');
        }
    }

    public function delete_folder($folder) {
        $flash = new Flash();
        if (!rmdir(UPLOAD_DIR.$folder)) {
            $flash->flash('flash_message', 'Error deleting '.$folder.'!', 'danger');
            header("Location: ".BASE_URL.'/admin/uploads/');
        }
        else {
            $flash->flash('flash_message', 'Folder: '.$folder.' deleted!');
            header("Location: ".BASE_URL.'/admin/uploads/');
        }
    }

    //Return bytes for php.ini filesize limit on uploads.
    public function return_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }

}