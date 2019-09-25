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
        $_SESSION['message'] = 'Remove a post successful';
        header("Location: managementposts.php");
    }

