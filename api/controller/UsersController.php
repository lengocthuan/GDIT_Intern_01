<?php
    require_once dirname(__DIR__) . '/config/config.php';

    if (isset($_POST['login'])) {
        header('Location: ' . LOCAL_PATH . LOGIN);
    }
?>