<?php
    require_once dirname(__DIR__) . '/model/model.php';
    require_once dirname(__DIR__) . '/config/config.php';
    require_once dirname(__DIR__) . '/common/checkLogin.php';
    session_start();
    $model = new Model($db);

    $timestamp = date('Y-m-d H:m:s', time());

    if (isset($_POST['create'])) {
        if (trim($_POST['editor1']) !== '') {
            $attack_fields = ['user_id' => $_SESSION['id'], 'created_at' => $timestamp, 'updated_at' => $timestamp, 'status' => 1];
            $fields = ['title' => trim($_POST['title']), 'content' => $_POST['editor1']];

            $fields = array_merge($fields, $attack_fields);

            if ($model->create('posts', $fields)) {
                header('Location: ' . LOCAL_PATH . HOME);
            }
        } 
    } else {
            $_SESSION['null'] = 'Please input content before apply';
            header('Location: ' . LOCAL_PATH . P_CREATE);
        }

    if (isset($_POST['update']) && trim($_POST['editor1']) !== '') {
        $where = ['', 'id' => $_POST['id_post']];
        $stmt_show = $model->show('posts', ['status'], $where);

        if ($stmt_show) {
            while ($row = $stmt_show->fetch()) {
                $status = $row['status'];
                if ($status == 3) {
                    $update_status = 2;
                }
            }
        }

        if (isset($update_status)) {
            $attack_fields = ['status' => $update_status, 'user_id' => $_SESSION['id'], 'updated_at' => $timestamp];
        } else {
            $attack_fields = ['user_id' => $_SESSION['id'], 'updated_at' => $timestamp];
        }

        $fields = ['title' => trim($_POST['title']), 'content' => $_POST['editor1']];
        $condition = ['', 'id' => $_POST['id_post']];
        $fields = array_merge($fields, $attack_fields);

        $stmt = $model->update('posts', $fields, $condition);
        if ($stmt) {
            header('Location: ' . LOCAL_PATH . HOME);
        }
    } 

    if (isset($_POST['upload']) || isset($_POST['remove'])) {
        foreach ($_POST['post'] as $selected) {
            $checkList[] = $selected;
        }

        $_SESSION['checkList'] = $checkList;

        if (isset($_POST['upload'])) {
            header('Location: ' . LOCAL_PATH . PUBLIC_POST);
        } else {
            header('Location: ' . LOCAL_PATH . REMOVE_POST);
        }
    }
?>