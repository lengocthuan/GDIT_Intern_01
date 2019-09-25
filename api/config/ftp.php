<?php
class Ftp
{
    public function connectFTP()
    {
         // FTP server details
        $ftp_host   = '127.0.0.1';
        $ftp_username = 'thuan';
        $ftp_password = 'thuan';

        // open an FTP connection
        $conn_id = ftp_connect($ftp_host) or die("Couldn't connect to $ftp_host");
         
        // login to FTP server
        $ftp_login = ftp_login($conn_id, $ftp_username, $ftp_password);
        return $conn_id;
    }
}
