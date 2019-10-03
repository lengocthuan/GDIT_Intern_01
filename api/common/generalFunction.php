<?php
    require_once dirname(__DIR__) . "/config/config.php";
    require_once dirname(__DIR__) . "/config/ftp.php";

    class General 
    {
        public function replaceContentForPartent ($partern, $replacement, $destination, $start)
        {
            $subject = file_get_contents($start);
            $data = preg_replace($partern, $replacement, $subject);
            return file_put_contents($destination, $data);
        }

        public function convert_vi_to_en($str)
        {
            $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
            $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
            $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
            $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
            $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
            $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
            $str = preg_replace("/(đ)/", "d", $str);
            $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
            $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
            $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
            $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
            $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
            $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
            $str = preg_replace("/(Đ)/", "D", $str);

            $str = strtolower($str);
            $str = str_replace( "ß", "ss", $str);
            $str = str_replace( "%", "", $str);
            $str = preg_replace("/[^_a-zA-Z0-9 -] /", "",$str);
            $str = str_replace(array('%20', ' '), '-', $str);
            $str = str_replace("----","-",$str);
            $str = str_replace("---","-",$str);
            $str = str_replace("--","-",$str);
          return $str;
        }

        public function checkCreateFile($name, $id)
        {
            $link = dirname(__DIR__,2) ."/temporary/$name" ."_$id.html";
            $create_new_file = fopen($link, "w");
            if ($create_new_file) {
                unlink($link);
                return true;
            }
            return false;
        }

        public function getImageName($original_image, $directory_in_ftp) {
            $image_local_storage = ORIGINAL . $original_image; //get link image saved at local storage ("http://localhost/GDIT/app/ckeditor/kcfinder/upload/image ...")
            $get_image_name = str_replace(IMAGE_LOCAL_P, "", $original_image); //get image name saved;
            $set_image_global_path = $directory_in_ftp . "/$get_image_name"; //create new path for save image in another server;

            $ftp = new Ftp();
            $connection = $ftp->connectFTP();

            if (ftp_put($connection, $set_image_global_path, $image_local_storage, FTP_ASCII)) {
                echo "File transfer successful - $get_image_name";echo "<br>";
                if (!ftp_chmod($connection, 0644, $set_image_global_path)){
                    echo "Error chmod file image has attack inside folder"; die();
                }
                return $get_image_name;
            } else {
                echo "There was an error while uploading $get_image_name";
            }
        }
    }
?>