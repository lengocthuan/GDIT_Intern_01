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
            $link = "$path" . "/template_for_user.html";

            $subject = file_get_contents($link);
            // print_r($content);die();
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

            //using FTP upload file html from LOCAL to GLOBAL
            $information_ftp = new Ftp();
            $conn_id = $information_ftp->connectFTP();

            // local & server file path
            $remoteFilePath = "$path" . "/global/$limitedTitle.html";

            // try to upload file
            if (ftp_put($conn_id, $remoteFilePath, $localFilePath, FTP_ASCII)) {
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