<?php
    require_once dirname(__DIR__,2) . "/common/header.php";

    if (session_destroy()) {
        header("Location:". LOCAL_PATH . "/index.php");
    }
?>
