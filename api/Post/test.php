<!-- <?php
    // Way 1:
    // $partern = "/<title>([^<]*)<\/title>/im";
    // $subject = file_get_contents('template_for_user.html');
    // $replacement = '<title>thuanh123456dsome</title>';
    // file_put_contents('template_for_user.html', preg_replace($partern, $replacement, $subject));

?> -->
<?php
    require_once dirname(__DIR__) . "/objects/model.php";
    // print_r("abc");
    $records = new Model($db);
    // $a = $records->a();
    $a = $records->index('posts');
    foreach ($a as $value) {
        echo $value;
    }
?>
