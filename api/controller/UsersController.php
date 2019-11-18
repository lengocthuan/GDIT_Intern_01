<?php
    require_once dirname(__DIR__) . '/config/config.php';
    require_once dirname(__DIR__) . '/model/model.php';
    session_start();

    $model = new Model($db);
    
    if (isset($_POST['login'])) {
        $fields = ['id', 'username', 'password'];
        $username = strval(trim($_POST['username']));
        $condition = ['', 'username' => $username];

        $stmt = $model->show(USERS, $fields, $condition);

        if ($stmt) {
            $row = $stmt->fetch();
            if ($row) {
                $id = $row['id'];
                $uname = $row['username'];
                $passwd = $row['password'];
            }

            $expected = strval(trim($_POST['password']));

            if (isset($passwd)) {
                $compare = password_verify($expected, $passwd);
                if ($compare) {
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $uname;
                        header('Location:' . LOCAL_PATH . HOME);
                }
            }
        }
        $_SESSION['login_fail'] = 'Password or Username failed.';
        header('Location:' . LOCAL_PATH . '/index.php');
    }

    if (isset($_POST['username'])) {
        $username = strval(trim($_POST['username']));

        if ($username != '') {
            $fields = [];
            $condition = ['', 'username' => $username];

            $stmt = $model->show(USERS, $fields, $condition);

            if ($stmt) {
                $row = $stmt->fetch();
                if ($row) {
                    echo 'taken'; 
                } else {
                    echo 'not_taken';
                }
            }
        }
    }

    if (isset($_POST['insert']) == 1) {
        $username = strval(trim($_POST['uname']));
        $passwd = strval(trim($_POST['passwd']));
        $passwd_confirm = strval(trim($_POST['passwd_confirm']));
        $timestamp = date('Y-m-d H:m:s', time());

        if ($username != '' && $passwd != '') {
            if (strcmp($passwd, $passwd_confirm) == 0) {
                $password = password_hash($passwd, PASSWORD_ARGON2I);
                $fields = ['username' => $username, 'password' => $password, 'created_at' => $timestamp, 'updated_at' => $timestamp];

                $stmt = $model->create(USERS, $fields);
                if ($stmt) {
                    echo 'successed';
                } else {
                    echo 'failed';
                }
            }
        }
    }
