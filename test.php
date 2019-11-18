<?php

// $input = password_hash('thuan12345', PASSWORD_ARGON2I);

// $a = new Database($db);
// var_dump($db);die();
// $options = [
//     'cost' => 14,
// ];
 // $old = '$2y$14$am7bKBnYh.EBCxOeX4cNsOHl37ZqIM2eIoYI4Jh2RcEPKxrFNtexa';
 $new = 'thuan1234';
 $old = '$argon2i$v=19$m=65536,t=4,p=1$VUdubWpOYUcveW5mZkZZRQ$IbxnCNDD0pjS4hzHzp0Zs750IUZssrYLAVV9oHJTyNY';
 // echo $old; die();

//  // die();
  $a = password_verify($new, $old);
  // var_dump($a) ;
// $a = '      djdjfld dfkaf ';
// echo strval(trim($a));

$timestamp = date('Y-m-d H:m:s', time());
echo $timestamp;