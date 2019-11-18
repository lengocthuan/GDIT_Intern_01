<?php
    // include database and object files
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/model.php";
    require_once dirname(__DIR__,2) . ('/common/generalFunction.php');
    require_once dirname(__DIR__,2) . ('/config/ftp.php');

    $model = new Model($db);
    $using = new Ftp();
    $get_name_title = new General();

    if (isset($_SESSION['checkList'])) {
        foreach ($_SESSION['checkList'] as $value) {
            $connection = $using->connectFTP();
            $contents_on_server = ftp_nlist($connection, IMAGES_GLOBAL); //Returns an array of filenames from the specified directory on success or FALSE on error.

            $folder_child_in_G = IMAGES_GLOBAL . $value;

            if (in_array($folder_child_in_G, $contents_on_server)) {
                $content_inside_child_folder = ftp_nlist($connection, $folder_child_in_G . '/');
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
                // $_SESSION['not_exist'] = "Folder $value hasn't exist on Global.";
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

            //remove file html publicized and file html on local
            $content_to_remove_on_ftps = ftp_nlist($connection, PATH_GLOBAL);

            foreach ($content_to_remove_on_ftps as $val) {
                if (strpos($val, $value)) {
                    if (!ftp_delete($connection, $val)) {
                        echo 'Cant remove file' . $val;
                    }
                }
            }

            //remove file html on local
            $path_local = LOCAL_ORIGINAL . '/local/';
            $content_to_remove_on_local = ftp_nlist($connection, $path_local);
            // var_dump($content_to_remove_on_local);die();
            foreach ($content_to_remove_on_local as $item) {
                if (strpos($item, $value)) {
                    if (!ftp_delete($connection, $item)) {
                        echo 'Cant remove file' . $item;
                    }
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
