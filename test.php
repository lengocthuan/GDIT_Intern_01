<?php
    //Way 1:
    $partern ='/src="/im';
    $subject = file_get_contents('template_for_user.html');
    $replacement = 'src="/var/www/html';
    file_put_contents('template_for_user.html', preg_replace($partern, $replacement, $subject));

?>
