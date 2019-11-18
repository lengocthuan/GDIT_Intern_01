<?php
    // include header
    require_once dirname(__DIR__,2) . ('/common/header.php');
    require_once dirname(__DIR__,2) . ('/config/ftp.php');
    require_once dirname(__DIR__,2) . ('/model/model.php');
    require_once dirname(__DIR__,2) . ('/common/generalFunction.php');
    // prepare model object
    $model = new Model($db);

    //using FTP upload file html from LOCAL to GLOBAL
    $information_ftp = new Ftp();
    $conn_id = $information_ftp->connectFTP();

    if (isset($_SESSION['checkList'])) {
        foreach ($_SESSION['checkList'] as $value) {
            $where = ['', 'id' => $value];
            $stmt = $model->show('posts', ['title', 'content'], $where);

            if ($stmt) {
                while ($row = $stmt->fetch()) {
                    $id_old = $row['id'];
                    $title = htmlspecialchars($row['title']);
                    $content = $row['content'];
                }
            }

            $path = dirname(__DIR__,3);
            $link = $path . '/template_for_user.html';

            $using = new General();

            $partern_title = '/<title>([^<]*)<\/title>/im';
            $replacement_title = "<title>$title</title>";
            $new_title = $using->replaceContentForPartent($partern_title, $replacement_title, $link, $link);

            $partern_content = '/<p>([^<]*)<\/p>/im';
            $replacement_content = $content;
            $new_content = $using->replaceContentForPartent($partern_content, $replacement_content, $link, $link);

            $partern_check_link_image_global = '/src="http/im';
            $subject = file_get_contents($link);
            preg_match_all($partern_check_link_image_global, $subject, $matches, PREG_SET_ORDER, 0);

            if (empty($matches)) {
                $partern_path_local = '/src="/im';
                $replacement_path_local = 'src="/var/www/html';
                $new_subject_content = $using->replaceContentForPartent($partern_path_local, $replacement_path_local, $link, $link);
            }

            $partent_youtube_iframe = 'https://www.youtube.com/watch?v=';
            $replace_youtube_iframe = 'https://www.youtube.com/embed/';
            $subject_youtube_iframe = file_get_contents($link);
            $result_youtube_iframe = str_replace($partent_youtube_iframe, $replace_youtube_iframe, $subject_youtube_iframe);
            file_put_contents($link, $result_youtube_iframe);

            $rename_title = $using->convert_vi_to_en($title);
            $check_title_before_create_file = $using->checkCreateFile($rename_title, $value);

            if ($check_title_before_create_file) {
                $local_file_path = $path . "/local/$rename_title" . "_$value.html";
            } else {
                $local_file_path = $path . "/local/the_post_$value.html";
                $rename_title = 'the_post';
            }

            if (!copy($link, $local_file_path)) {
                echo "Failed to copy $link...\n";
                echo 'Log out and Log in again, please.';
            }

            if (!chmod($local_file_path, 0777)) {
                echo "$local_file_path error when chmod for this file.";
            }

            //reset content file template from a original file html
            $original = $path . "/original.html";

            if(!copy($original, $link)) {
                echo "Fail to copy $original...\n";
            }

            //copy image from local to server ftp
            //export link of image in post
            $regex = '/src="([^"]+)"/'; //get string in scr= ""
            preg_match_all($regex, $content, $matches, PREG_SET_ORDER, 0);
            
            $original = '/var/www/html';

            $originalLocal = '/GDIT/app/ckeditor/kcfinder/upload/images/';

            // Directory name which is to be created
            // $dir = PATH_GLOBAL . $value;
            $dir_images = PATH_GLOBAL . 'images/' . $value;
            // var_dump($dir_images); die();
            // Creating directory 
            if (ftp_mkdir($conn_id, $dir_images)) {
                // Execute if directory created successfully 
                echo "$dir_images Successfully created";echo "<br>";
                if (ftp_chmod($conn_id, 0777, $dir_images)) {
                // Execute if directory created successfully 
                    echo "$dir_images Successfully chmod";echo "<br>";
                    foreach ($matches as $path_local) {
                        $using->getImageName($path_local[1], $dir_images, $value);
                    }
                } else {
                    echo "There was an error while chmod $image_local";
                }
            }
            else {
                // Execute if fails to create directory
                $path_to_images = PATH_GLOBAL . 'images/';
                $contents_on_server = ftp_nlist($conn_id, $path_to_images); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array
                if (in_array($dir_images, $contents_on_server)) {
                    foreach ($matches as $path_local) {
                        $get_image = $using->getImageName($path_local[1], $dir_images, $value);
                        if (isset($get_image)) {
                            $array_using[] = $get_image;
                        }
                    }

                    $check_content_in_directory = ftp_nlist($conn_id, $dir_images);

                    foreach ($check_content_in_directory as $item) {
                        $path_info = pathinfo($item);
                        if ($path_info['extension'] != "html") {
                            $list_content[] = $path_info['basename'];
                        }
                    }
                    //get file need delete
                    $array_need_delete = array_diff($list_content, $array_using);
                    foreach ($array_need_delete as $val) {
                        if (!ftp_delete($conn_id, $dir_images . "/$val")) {
                            echo "Cant delete this file $val cause file not exist or deleted.";
                        }
                    }
                }
                else {
                    echo "<br>";
                    echo $dir_images .  'not found directory :'  . PATH_GLOBAL;
                }
            }
            //create a temp file from file html at local and replace src img old by new img link;
            $temp_html = dirname(__DIR__,3) . "/temp.html"; //path local file final;
            $partent_temp_html = "/\/var\/www\/html\/GDIT\/app\/ckeditor\/kcfinder\/upload\/images\//";
            $replacement_temp_html = '/images/' . $value . '/';

            $using->replaceContentForPartent($partent_temp_html, $replacement_temp_html, $temp_html, $local_file_path);

            // local & server file path
            $remoteFilePath = PATH_GLOBAL . $rename_title . "_"  . "$value.html";

            // try to upload file
            if (ftp_put($conn_id, $remoteFilePath, $temp_html, FTP_ASCII)) {
                echo "File transfer successful - $local_file_path";
                if (!ftp_chmod($conn_id, 0644, $remoteFilePath)) {
                    echo "Error when chmod for file $remoteFilePath";
                }
            } else {
                echo "There was an error while uploading $local_file_path";
            }

            file_put_contents($temp_html, "");

            //update status in db
            $timestamp = date('Y-m-d h:i:s', time());

            $fields = ['status' => 3, 'updated_at' => $timestamp, 'path_in_global' => "/$rename_title" . "_$value.html"];
            $condition = ['', 'id' => $value];
            $model->update('posts', $fields, $condition);
        }
    }

    //close ftp
    ftp_close($conn_id);
    unset($_SESSION['checkList']);
    $_SESSION['successful'] = "Upload file successful.";
    ob_end_clean();
    header("Location: managementposts.php");
?>