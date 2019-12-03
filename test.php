<?php

require_once dirname(__FILE__) . '/api/config/config.php';
require_once dirname(__FILE__) . '/api/config/ftp.php';
// date_default_timezone_set("Asia/Ho_Chi_Minh");
// $timestamp = date('Y-m-d H:i:s', time());
// echo $timestamp;
// echo "<br>";
//using FTP upload file html from LOCAL to GLOBAL
$information_ftp = new Ftp();
$conn_id = $information_ftp->connectFTP();

$list = ftp_nlist($conn_id, '/global/a/b/c/');
// var_dump($list[0]);
foreach ($list as $value) {
	$pathinfo = pathinfo($value);
	$array[] = $pathinfo['dirname'];
}
// var_dump($array); die();
if (!ftp_rmdir($conn_id, $array[0])) {
	if(!ftp_delete($conn_id, '/global/a/b/c/abc.html')){
		echo 'folder clean, ready for empty.';
	} else {
		// echo 'a'; die();
		$check_list = explode('/', $array[0]); //global a b c //[/global/a/b/c]
		unset($check_list[0]);
		$index = count($check_list);
		// var_dump($check_list); die();
		if (ftp_rmdir($conn_id, $list[0])) {
			while($index) {
				// remove c 
				$a = $check_list[--$index];
				// $list[0] = '/' . implode('/', $check_list); break;
				if (($key = array_search($a, $check_list)) !== false) {
					unset($check_list[$key]);
					$reboot_path = '/' . implode('/', $check_list);
					if (ftp_rmdir($conn_id, $reboot_path)){
						break;
					}
				}
			}
		}
	}
}


// var_dump($conn_id); die();
// $path_local = LOCAL_ORIGINAL . '/local/';
// echo 'a'; die();
// get contents of the current directory
// $contents = ftp_mlsd($conn_id, '/global');

// // output $contents
// print_r($contents);
// $value = '35';
// $content_to_remove_on_local = scandir($path_local);
// print_r($content_to_remove_on_local);
// foreach ($content_to_remove_on_local as $item) {
//     if (strpos($item, $value)) {
//     	// $need = $path_local . $item;
//     	// var_dump($need); die();
//         if (!unlink($path_local . $item)) {
//             echo 'Cant remove file' . $item;
//         }
//     }
// }

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
