<?php
    // include database and object files

    require_once ('../config/database.php');
    require_once ('../config/ftp.php');
    require_once ('../objects/posts.php');
    require_once ('../objects/converstring.php');
    session_start();

    // get database connection
    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

    if (isset($_SESSION['checkList'])) {
        foreach ($_SESSION['checkList'] as $value) {
            $stmt = $post->editPost($value);

            while ($row = $stmt->fetch())
            {
                $idOld = $row['id'];
                $title = $row['title'];
                $content = $row['content'];
            }

            $path = dirname(__DIR__,2);
            $path_global = "/home/thuan/global";
            $link = "$path" . "/template_for_user.html";

            $subject = file_get_contents($link);
            $parternTitle = "/<title>([^<]*)<\/title>/im";
            $replacementTitle = "<title>$title</title>";
            file_put_contents($link, preg_replace($parternTitle, $replacementTitle, $subject));

            $newSubject = file_get_contents($link);
            $parternContent = "/<p>([^<]*)<\/p>/im";
            $replacementContent = "$content";
            file_put_contents($link, preg_replace($parternContent, $replacementContent, $newSubject));

            $parternPathLocal = '/src="/im';
            $replacementPathLocal = 'src="/var/www/html';
            $newSubjectContent = file_get_contents($link);
            file_put_contents($link, preg_replace($parternPathLocal, $replacementPathLocal, $newSubjectContent));

            $convert = new ConvertString();
            $renameTitle = $convert->convert_vi_to_en($title);
            $limitedTitle = substr($renameTitle, 0, 50);
            $localFilePath = "$path" . "/local/$limitedTitle.html";

            if (!copy($link, $localFilePath)) {
                echo "Failed to copy $link...\n";
                echo "Log out and Log in again, please.";
            }

            //recreate a original file html
            $original = "$path" . "/original.html";

            if(!copy($original, $link)) {
                echo "Fail to copy $original...\n";
            }

            //copy image from local to server ftp
            //export link of image in post
            $regex = '/src="([^"]+)"/'; //get string in scr= ""
            preg_match_all($regex, $content, $matches, PREG_SET_ORDER, 0);

            // var_dump($matches[0][1]);
            $original = "/var/www/html";
            $originalGlobal = "/home/thuan/global/";
            $originalLocal = "/GDIT/app/ckeditor/kcfinder/upload/images/";
            //using FTP upload file html from LOCAL to GLOBAL
            $information_ftp = new Ftp();
            $conn_id = $information_ftp->connectFTP();

            // Directory name which is to be created
            $dir = $originalGlobal . "$limitedTitle";

            // Creating directory 
            if (ftp_mkdir($conn_id, $dir)) {
                // Execute if directory created successfully 
                echo "$dir Successfully created";echo "<br>";
                if (ftp_chmod($conn_id, 0777, $dir)) {
                // Execute if directory created successfully 
                    echo "$dir Successfully chmod";echo "<br>";
                    foreach ($matches as $pathLocal) {
                        // try to upload file
                        $imageLocal = $original . $pathLocal[1]; // var/www/html/GDIT/app/ckeditor/.../imagename.jpg|* //image in local;

                        $imageName = str_replace($originalLocal, "", $pathLocal[1]); //get image name saved;
                        $imageGlobal = $dir . "/" . "$imageName"; //create new path for save image;

                        // $image_new_list [] = $imageGlobal;

                        if (ftp_put($conn_id, $imageGlobal, $imageLocal, FTP_ASCII)) {
                            echo "File transfer successful - $imageLocal";echo "<br>";
                        } else {
                            echo "There was an error while uploading $imageLocal";
                        }
                    }
                } else {
                        echo "There was an error while chmod $imageLocal";
                }
            }
            else {
                // Execute if fails to create directory 
                // echo "Error while creating $dir";
                $contents_on_server = ftp_nlist($conn_id, $originalGlobal); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array
                if (in_array($dir, $contents_on_server)) {
                    echo "<br>";
                    echo "I found ". $dir ." directory has exist in " . $originalGlobal;
                }
                else
                {
                    echo "<br>";
                    echo $dir . " not found directory : " . $originalGlobal;
                }
            }
            // die();
            //create a temp file from file html at local and replace src img old by new img link;
            $temp_html = "/var/www/html/GDIT/app/temp.html";
            $get_temp_html = file_get_contents($localFilePath); //get content file created at local folder;
            $partent_temp_html = "/\/var\/www\/html\/GDIT\/app\/ckeditor\/kcfinder\/upload\/images\//";
            $replacement_temp_html = $dir . "/";
            $new_temp_html = file_put_contents($temp_html, preg_replace($partent_temp_html, $replacement_temp_html, $get_temp_html));

            // local & server file path
            $remoteFilePath = $replacement_temp_html . "/$limitedTitle.html";

            // try to upload file
            if (ftp_put($conn_id, $remoteFilePath, $temp_html, FTP_ASCII)) {
                echo "File transfer successful - $localFilePath";
            } else {
                echo "There was an error while uploading $localFilePath";
            }
            //close ftp
            ftp_close($conn_id);
        }
    }

    unset($_SESSION['checkList']);
    $_SESSION['successful'] = "Upload file successfull.";
    ob_end_clean();
    header("Location: managementposts.php");
?>