<?php
    // include database and object files
    require_once ('./api/config/database.php');
    require_once ('./api/config/ftp.php');
    require_once ('./api/objects/posts.php');
    require_once ('./api/objects/converstring.php');

    session_start();
    ob_start();
    // get database connection
    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

    $id = $_GET['idpost'];

    $stmt = $post->editPost($id);

    while ($row = $stmt->fetch())
    {
        $idOld = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>POST PUBLIC</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
</head>

<body>
    <div style="width: auto; border: 15px solid blue;padding: 50px;margin: 20px;">
        <div style="text-align: center;">
            <h2><?php echo $title; ?></h2>
        </div>
        <div style="text-align: center;">
            <?php echo $content; ?>
        </div>
    </div>
</body>

</html>
<?php
    $convert = new ConvertString();
    $str = $convert->convert_vi_to_en($title);

    $tz = 'Asia/Ho_Chi_Minh';
    $tz_obj = new DateTimeZone($tz);
    $today = new DateTime("now", $tz_obj);
    $today_formatted = $today->format('Y-m-d H:m:s');

    file_put_contents('template.html', ob_get_contents());

    $file = 'template.html';

    $newfile = "local/$str.html";
    chmod("$newfile", 0777);
    // print_r($newfile);die();
    if (!copy($file, $newfile)) {
        echo "failed to copy";
    }
?>
<?php
    $information_ftp = new Ftp();
    $conn_id = $information_ftp->connectFTP();

    // local & server file path
    $localFilePath  = $newfile;
    $remoteFilePath = "/var/www/html/GDIT/app/global/$str.html";

    // try to upload file
    if (ftp_put($conn_id, $remoteFilePath, $localFilePath, FTP_ASCII)) {
        echo "File transfer successful - $localFilePath";
    } else {
        echo "There was an error while uploading $localFilePath";
    }
    // print_r($remoteFilePath);
    chmod("$remoteFilePath", 0644);
    // close the connection
    ftp_close($conn_id);
?>