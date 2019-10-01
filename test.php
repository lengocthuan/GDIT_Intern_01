<!-- <?php
    //Way 1:
    // $replacement ='a';
    // // $subject = file_get_contents('local/45678992.html');
    // $subject = 'co bao gio con song khong xo vao bo';
    // $partern = 'co bao gio';
    // // file_put_contents('local/45678992.html', preg_replace($partern, $replacement, $subject));
    // // var_dump(preg_replace($partern, $replacement, $subject)) ;
    // var_dump(preg_replace('/\/var\/www\/html\//', ' ', 'src="/var/www/html/GDIT/app/ckeditor/kcfinder/upload/images/nghiale01.jpg"')) ;
    // var_dump(preg_replace('/^.+_|\.[^.]+$/', ' ', 'src="/var/www/html/GDIT/app/ckeditor/kcfinder/upload/images/nghiale01.jpg"')) ;
?> -->
<?php
//     require_once ('api/config/database.php');
//     require_once ('api/objects/posts.php');
        require_once ('api/config/ftp.php');

//     // get database connection
//     $database = new Database();

//     $db = $database->getConnection();

//     // prepare post object
//     $post = new Post($db);

//     $value = 24;
//     $stmt = $post->editPost($value);

//     while ($row = $stmt->fetch())
//     {
//         $idOld = $row['id'];
//         $title = $row['title'];
//         $content = $row['content'];
//     }

//     $regex = '/src="([^"]+)"/'; 
// /*    $str = '<p><img alt="" src="/GDIT/app/ckeditor/kcfinder/upload/images/nghiale01.jpg" style="height:67px; width:100px" /><img alt="" src="/GDIT/app/ckeditor/kcfinder/upload/images/phu03.jpg" style="height:100px; width:100px" />&nbsp;</p>

//     <p>nhkijnk</p>';*/

//     preg_match($regex, $content, $matches, PREG_SET_ORDER, 1);

//     // Print the entire match result
//     var_dump($matches);

    // chmod("/var/www/html/GDIT/app/global/abc_152-", 777);
    // exec ("find /var/www/html/GDIT/app/global/abc_152- -type d -exec chmod 0770 {} +");
        // print_r('abc1');
    //         $information_ftp = new Ftp();
    //         $conn_id = $information_ftp->connectFTP();

    // // check if a file exist
    //         $path = "/var/www/html/GDIT/app/global"; //the path where the file is located
    //         $pathFolder = "/var/www/html/GDIT/app/global/15615"; //the path where the file is located

    //         // $file = "file.html"; //the file you are looking for

    //         // $check_file_exist = $path.$file; //combine string for easy use

    //         $contents_on_server = ftp_nlist($conn_id, $path); //Returns an array of filenames from the specified directory on success or FALSE on error.

    //         // Test if file is in the ftp_nlist array
    //         if (in_array($pathFolder, $contents_on_server)) 
    //         {
    //             echo "<br>";
    //             echo "I found ".$pathFolder." directory has exist in " . $path;
    //         }
    //         else
    //         {
    //             echo "<br>";
    //             echo $pathFolder." not found directory : ".$path;
    //         }

    //         // output $contents_on_server, shows all the files it found, helps for debugging, you can use print_r() as well
    //         // var_dump($contents_on_server);
    //         ftp_close($conn_id);
            function replace($partent, $replacement, $subject, $file) {
                $subject = file_get_contents($file);
                return file_put_contents($link, preg_replace($partent, $replacement, $subject));
            }
            $link = "local/15615.html";
            // $array = ["ba", "bama"];
            $array = ["/var/www/html/GDIT/app/global/15615/nghiale01.jpg", "/var/www/html/GDIT/app/global/15615/phu03.jpg"];
            
            // foreach ($array as $key => $value) {
            //     // echo $value; die();
            //     if ($value == "/var/www/html/GDIT/app/global/15615/nghiale01.jpg") {
            //         unset($array[$key]);
            //     }
            // }
            // var_dump($array); die();
            $subject = file_get_contents($link);
            $partern = '/src="([^"]+)"/';
            preg_match_all($partern, $subject, $matches, PREG_SET_ORDER, 0);
            // $new = array_replace($matches, $array);
            // var_dump($new); die();
            // foreach ($array as $key => $new) {
            //     foreach ($matches as $k => $old) {
            //         var_dump($old[1]);die();
            //         $change = array_replace($old[1], $new, $subject);
            //         file_put_contents($link, $change);break;
            //         // unset($matches[$k]);
            //     }
            //     unset($array[$key]);
            // }
            // foreach ($matches as $val) {
            //         $change = array_replace($val[1], $array, $subject);
            //         unset($array);
            //         file_put_contents($link, $change);
            //         print_r($val[1]);echo "<br>";
            //     }
                // echo $value; echo "<br>";
            // }
            // die();
            foreach ($matches as $value) {
                // print_r($value[1]);
                foreach ($array as $val) {
                    // echo $val; echo "<br>";
                    // echo $array;die();
                    // break;
                    $change = str_replace($value[1], $val, $subject);
                    // unset($val);
                    file_put_contents($link, $change);break;
                }
                $subject = file_get_contents($link);
                var_dump($subject);echo "<br>";
                die();
            }
            // var_dump($arrayold0);
?>