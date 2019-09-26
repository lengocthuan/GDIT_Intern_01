<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        $message = 'You must be logged in to access this page';
    }
