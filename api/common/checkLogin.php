<?php
    require_once dirname(__DIR__) . '/config/config.php';
    session_start();

    if (!isset($_SESSION['id'])) {
        session_destroy();
        header("Location: " . LOCAL_PATH . '/index.php');
    }
