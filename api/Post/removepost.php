<?php
    // include database and object files
    require_once dirname(__DIR__) . "/common/header.php";
    require_once dirname(__DIR__) . "/objects/posts.php";
    require_once dirname(__DIR__) . ('/common/generalFunction.php');
    require_once dirname(__DIR__) . ('/config/ftp.php');

    // prepare post object
    $post = new Post($db);

    // $id = $_GET['idpost'];

    // $stmt = $post->removepost($id);

    // if ($stmt) {
    //     $_SESSION['rmsuccessful'] = "Remove a post successful.";
    //     header("Location: managementposts.php");
    // }

    if (isset($_SESSION['checkList'])) {
        foreach ($_SESSION['checkList'] as $value) {
            // $stmt = $post->removepost($value);

            $stmt = $post->editPost($value);

            while ($row = $stmt->fetch())
            {
                $title = $row['title'];
            }
            $using = new General();

            $rename_title = $using->convert_vi_to_en($title);
            $limited_title = substr($rename_title, 0, 50);
            $file_name = "$limited_title" . "_$id_old.html";
            $path_file_name = LOCAL_PATH . "/local/$limited_title" . "_$id_old.html";
            $folder_name = "$limited_title" . "_$id_old.html";

            // Execute if fails to create directory
            $contents_on_server = ftp_nlist($conn_id, PATH_GLOBAL); //Returns an array of filenames from the specified directory on success or FALSE on error.
            $contents_on_local = ftp_nlist($conn_id, LOCAL_PATH . "/local/");
            // Test if file is in the ftp_nlist array
            if (in_array($file_name, $contents_on_local)) {
                if (!unlink($path_file_name)) {
                    echo "File $limited_title error when deleting.";
                }
            }
            if (in_array($folder_name, $contents_on_server)) {
                if (!ftp_rmdir($conn_id, $folder_name)) {
                    echo "Problem deleting $folder_name";
                }
            }

            $stmt = $post->removepost($value);
            if ($stmt) {
                $deleted[] = $value;
            }
        }
        if (isset($deleted)) {
            $_SESSION['rmsuccessful'] = "Remove posts $deleted successful";
        }
    }

    header("Location: managementposts.php");
