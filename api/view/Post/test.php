<!-- <?php
    // Way 1:
    // $partern = "/<title>([^<]*)<\/title>/im";
    // $subject = file_get_contents('template_for_user.html');
    // $replacement = '<title>thuanh123456dsome</title>';
    // file_put_contents('template_for_user.html', preg_replace($partern, $replacement, $subject));

?> -->
<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/objects/model.php";
    // print_r("abc");
    $records = new Model($db);
    // $a = $records->a();
    $all = $records->index('posts', '', ['ORDER BY `updated_at` DESC']);
    // var_dump($a);
    if ($all) {
        while($row = $all->fetch()) {
            $title[] = $row['title'];
        }
    }
    var_dump($title);

    

?>
