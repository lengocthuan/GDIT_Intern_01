<?php
    require_once dirname(__DIR__) . '/model/model.php';
    require_once dirname(__DIR__) . '/config/config.php';
    require_once dirname(__DIR__) . '/common/checkLogin.php';
    session_start();
    $model = new Model($db);

    $timestamp = date("Y-m-d H:i:s", time());

    if (isset($_POST['create']) == 1) {
        $attack_fields = ['user_id' => $_SESSION['id'], 'created_at' => $timestamp, 'updated_at' => $timestamp, 'status' => 1];
        $fields = ['title' => strval(trim(addslashes($_POST['title']))), 'content' => $_POST['content']];

        $fields = array_merge($fields, $attack_fields);
        if ($model->create('posts', $fields)) {
            echo LOCAL_PATH . HOME;
        } else {
            echo 'unsuccessful';
        }
    }

    if (isset($_POST['edit']) == 1) {
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

        $fields = ['title' => strval(trim(addslashes($_POST['title']))), 'content' => $_POST['content']];
        $condition = ['', 'id' => $_POST['id_post']];
        $fields = array_merge($fields, $attack_fields);

        $stmt = $model->update('posts', $fields, $condition);
        if ($stmt) {
            echo LOCAL_PATH . HOME;
        } else {
            echo 'Error-edit';
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