<?php
    include_once dirname(__DIR__) . "/config/config.php";
    require_once dirname(__DIR__) . "/config/database.php";
    require_once dirname(__DIR__) . "/common/checkLogin.php";

    session_start();
    ob_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <title><?php echo MANAGE; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo LOCAL_PATH . '/assets/favicon.png';?>"/>
    <link rel="stylesheet" prefetch href="https://fonts.googleapis.com/css?family=Open+Sans:600">

    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/fontawesome/css/all.min.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/css/posts.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/css/createpost.css';?>">
    <link rel="stylesheet" href="<?php echo LOCAL_PATH . '/assets/css/navigation.css';?>">

    <script src="<?php echo LOCAL_PATH . '/assets/js/jquery.min.js' ; ?>"></script>
    <script src="<?php echo LOCAL_PATH . '/assets/js/jquery.bootpag.min.js' ; ?>"></script>
    <script src="<?php echo LOCAL_PATH . '/assets/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo LOCAL_PATH . '/ckeditor/ckeditor.js';?>"></script>

</head>
<body>
    <div class="topnav fixed-top">
        <a href="<?php echo LOCAL_PATH . HOME?>" class="text-success float-left">Home</a>
        <a class="float-right text-primary"><?php echo $_SESSION['username']; ?></a>
        <a href="../User/logout.php" style="float: right;">Logout</a>
    </div>
</body>