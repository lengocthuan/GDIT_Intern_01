<?php
    // include database and object files
    require_once '../config/database.php';
    require_once '../objects/posts.php';

    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

    session_start();

    if (!isset($_SESSION['id'])) {
        $message = 'You must be logged in to access this page';
    }

    $id = $_GET['idpost'];

    $stmt = $post->removepost($id);

    if ($stmt) {
        echo "<script  type='text/javascript' charset='utf-8'>
                    window.alert('Remove a post successful');
                    window.location.href='managementposts.php';
                </script>";
    }

