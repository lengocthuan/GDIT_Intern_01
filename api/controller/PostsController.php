<?php
    require_once dirname(__DIR__) . '/model/model.php';
    require_once dirname(__DIR__) . '/config/config.php';
    require_once dirname(__DIR__) . '/common/generalFunction.php';

    $model = new Model($db);

    $timestamp = date('Y-m-d h:i:s', time());

    if (isset($_POST['create'])) {
        $attack_fields = ['user_id' => $_SESSION['id'], 'created_at' => $timestamp, 'updated_at' => $timestamp, 'status' => 1];
    	$fields = ['title' => trim($_POST['title']), 'content' => $_POST['editor1']];

        $fields = array_merge($fields, $attack_fields);

    	if ($model->create('posts', $fields)) {
    		header('Location: ' . LOCAL_PATH . HOME);
    	}
    }

    if (isset($_POST['update'])) {
        $attack_fields = ['user_id' => $_SESSION['id'], 'updated_at' => $timestamp];
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