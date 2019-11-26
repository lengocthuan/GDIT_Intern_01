<?php
    // include database and object files

    require_once dirname(__DIR__,2) . '/common/header.php';
    require_once dirname(__DIR__,2) . '/model/user.php';
    // echo "abc"; die();
    // prepare user object
    $user = new User($db);
    // set ID property of user to be edited
    $user->username = isset($_GET['username']) ? $_GET['username'] : die();
    $user->password = isset($_GET['password']) ? $_GET['password'] : die();
    // echo $_GET['username'] . " - = - " . $_GET['password']; die();
    // read the details of user to be edited
    $stmt = $user->login();

    if ($stmt->rowCount() > 0) {
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // create array
        $user_arr = array(
            'status' => true,
            'message' => 'Successfully Login!',
            'id' => $row['id'],
            'username' => $row['username'],
        );

        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header('Location:' . LOCAL_PATH . HOME);
    } else {
        $user_arr = array(
            'status' => false,
            'message' => 'Invalid Username or Password!',
        );
        $_SESSION['failed'] = 'Invalid Username or Password!';
    }
?>
