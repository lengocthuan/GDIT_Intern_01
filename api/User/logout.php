<?php
    require_once dirname(__DIR__) . "/common/header.php";

    if (session_destroy()) {
        header("Location:". LOCAL_PATH . "/index.php");
    }
?>
