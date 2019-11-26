<?php

require_once dirname(__FILE__) . '/api/config/config.php';
// //using FTP upload file html from LOCAL to GLOBAL
// $information_ftp = new Ftp();
// $conn_id = $information_ftp->connectFTP();
// var_dump($conn_id); die();
$path_local = LOCAL_ORIGINAL . '/local/';
$value = '35';
$content_to_remove_on_local = scandir($path_local);
print_r($content_to_remove_on_local);
foreach ($content_to_remove_on_local as $item) {
    if (strpos($item, $value)) {
    	// $need = $path_local . $item;
    	// var_dump($need); die();
        if (!unlink($path_local . $item)) {
            echo 'Cant remove file' . $item;
        }
    }
}

// $a = new Database($db);
// var_dump($db);

// $options = [
//     'cost' => 14,
// ];
// $old = '$2y$14$am7bKBnYh.EBCxOeX4cNsOHl37ZqIM2eIoYI4Jh2RcEPKxrFNtexa';
//  $new = 'thuan1234';
//  // thuan12345
//  $old = '$argon2i$v=19$m=65536,t=4,p=1$VUdubWpOYUcveW5mZkZZRQ$IbxnCNDD0pjS4hzHzp0Zs750IUZssrYLAVV9oHJTyNY';
//  // echo $old;

// //  // die();
//   $a = password_verify($new, $old);
//   // var_dump($a) ;
// // $a = '      djdjfld dfkaf ';
// // echo strval(trim($a));

// $timestamp = date('Y-m-d H:m:s', time());
// require_once dirname(__FILE__) . '/api/config/config.php';
// $home = LOCAL_PATH . HOME;
