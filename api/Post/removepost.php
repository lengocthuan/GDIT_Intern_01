<?php
    // include database and object files
    require_once dirname(__DIR__) . "/common/header.php";
    require_once dirname(__DIR__) . "/objects/posts.php";
    require_once dirname(__DIR__) . ('/common/generalFunction.php');
    require_once dirname(__DIR__) . ('/config/ftp.php');

    if (isset($_SESSION['checkList'])) {
        foreach ($_SESSION['checkList'] as $value) {
            // $stmt = $post->removepost($value);

            // $stmt = $post->editPost($value);

            // while ($row = $stmt->fetch())
            // {
            //     $id = $row['id'];
            //     $title = $row['title'];
            // }
            $using = new Ftp();
            $connection = $using->connectFTP();
            // $rename_title = $using->convert_vi_to_en($title);
            // $limited_title = substr($rename_title, 0, 50);
            // $file_name = "$limited_title" . "_$id_old.html";
            // $path_file_name = LOCAL_PATH . "/local/$limited_title" . "_$id_old.html";
            // $folder_name = "$limited_title" . "_$id_old.html";

            // Execute if fails to create directory
            //Remove file and folder after uploaded on global server
            $contents_on_server = ftp_nlist($connection, PATH_GLOBAL); //Returns an array of filenames from the specified directory on success or FALSE on error.

            $folder_child_in_G = PATH_GLOBAL . $value;

            if (in_array($folder_child_in_G, $contents_on_server)) {
                $content_inside_child_folder = ftp_nlist($connection, $folder_child_in_G . "/");
                foreach ($content_inside_child_folder as $need_remove) {
                    if (!ftp_delete($connection, $need_remove)) {
                        echo "Problem deleting children file inside folder $value";
                        echo "Cant remove this folder $value with items inside it.";
                        break;
                    } else {
                        if (!ftp_rmdir($connection, $folder_child_in_G)) {
                            echo "Cant remove this folder $value at it's address: $folder_child_in_G";
                        }
                    }
                }
            } else {
                echo "Folder $value hasn't exist on Global."; break;
            }

            echo "abc";
            var_dump($content_on_folder);
            die();
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
