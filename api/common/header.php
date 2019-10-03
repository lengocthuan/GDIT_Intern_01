<?php
    include_once dirname(__DIR__,1) . "/config/config.php";
    require_once dirname(__DIR__,1) . "/config/database.php";
    require_once dirname(__DIR__,1) . "/common/checkLogin.php";

    session_start();
    ob_start();

    $database = new Database();

    $db = $database->getConnection();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta charset="UTF-8">

    <title>Management Posts</title>

    <link rel="stylesheet" prefetch href="https://fonts.googleapis.com/css?family=Open+Sans:600">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/fontawesome/css/all.min.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/css/posts.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/css/createpost.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/css/navigation.css';?>">

    <script src="<?php echo LOCAL_PATH . '/assets/js/jquery.min.js' ; ?>"></script>
    <script src="<?php echo LOCAL_PATH . '/assets/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo LOCAL_PATH . '/ckeditor/ckeditor.js';?>"></script>

</head>
<body>
    <div class="topnav fixed-top">
        <a href="<?php echo LOCAL_PATH . "/api/Post/managementposts.php"?>" class="text-success float-left">Home</a>
        <a class="float-right text-primary"><?php echo $_SESSION['username']; ?></a>
        <a href="../User/logout.php" style="float: right;">Logout</a>
    </div>
</body>