<?php
    // include database and object files
    require_once dirname(__DIR__,2) . "/common/header.php";
    // require_once dirname(__DIR__,2) . "/model/posts.php";
    require_once dirname(__DIR__,2) . "/model/model.php";
    require_once dirname(__DIR__,2) . ('/common/generalFunction.php');
    require_once dirname(__DIR__,2) . ('/config/ftp.php');

    $model = new Model($db);
    $using = new Ftp();
    $get_name_title = new General();

    if (isset($_SESSION['checkList'])) {
        foreach ($_SESSION['checkList'] as $value) {
            $connection = $using->connectFTP();
            $contents_on_server = ftp_nlist($connection, PATH_GLOBAL); //Returns an array of filenames from the specified directory on success or FALSE on error.

            $folder_child_in_G = PATH_GLOBAL . $value;

            if (in_array($folder_child_in_G, $contents_on_server)) {

                $content_inside_child_folder = ftp_nlist($connection, $folder_child_in_G . "/");
                foreach ($content_inside_child_folder as $need_remove) {
                    if (!ftp_delete($connection, $need_remove)) {
                        echo "Problem deleting children file inside folder $value";
                        echo "Cant remove this folder $value with items inside it.";
                        break;
                    }
                }
                if (!ftp_rmdir($connection, $folder_child_in_G)) {
                            echo "Cant remove this folder $value at it's address: $folder_child_in_G";break;
                }
            } else {
                $_SESSION['not_exist'] = "Folder $value hasn't exist on Global.";
                header("Location: managementposts.php");
            }

            //get information title from db
            $where = ['', 'id' => $value];
            $stmt = $model->show('posts', ['title', 'content'], $where);

            if ($stmt) {
                while ($row = $stmt->fetch()) {
                    $title = htmlspecialchars($row['title']);
                }
            }

            //create html file name and check
            $rename_title = $get_name_title->convert_vi_to_en($title);
            $check_title_before_create_file = $get_name_title->checkCreateFile($rename_title, $value);

            if ($check_title_before_create_file) {
                $local_file_path = LOCAL_ORIGINAL . "/local/$rename_title" . "_$value.html";
            } else {
                $local_file_path = LOCAL_ORIGINAL . "/local/the_post_$value.html";
            }

            $file_local_need_remove = $local_file_path;

            if (!empty($local_file_path)) {
                if (!unlink($file_local_need_remove)) {
                    echo "Cant remove file with id: $value";
                }
            }

            //remove post in db
            $condition = ['', 'id' => $value];
            if ($model->destroy('posts', $condition)) {
                $deleted[] = $value;
            }
        }

        if (!empty($deleted)) {
            $string_deleted = implode(",", $deleted);
            $_SESSION['rmsuccessful'] = "Remove posts $string_deleted successful";
            header("Location: managementposts.php");
        }
    }
