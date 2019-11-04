<?php
    require_once 'config.php';

    class Ftp
    {
        public function connectFTP()
        {
             // FTP server details
            $ftp_host   = FTP_HOST;
            $ftp_username = FTP_USERNAME;
            $ftp_password = FTP_PASSWD;

            // open an FTP connection
            $conn_id = ftp_connect($ftp_host) or die("Couldn't connect to $ftp_host");
             
            // login to FTP server
            $ftp_login = ftp_login($conn_id, $ftp_username, $ftp_password);
            return $conn_id;
        }
    }
?>