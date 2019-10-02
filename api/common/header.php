<?php
    include_once dirname(__DIR__,1) . "/config/config.php";
    include_once dirname(__DIR__,2) . "/header.html";
    require_once dirname(__DIR__,1) . "/config/database.php";

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

    <script src="<?php echo LOCAL_PATH . '/assets/js/jquery.min.js' ; ?>"></script>
    <script src="<?php echo LOCAL_PATH . '/assets/bootstrap/js/bootstrap.min.js'; ?>"></script>

</head>
