<?php
    define("FTPHOST", "127.0.0.1");
    define("FTPUSER","thuan");
    define("FTPPASS","thuan");
    define("ROOT_PATH","/GDIT/app");
    define("DOCUMENT_ROOT","var/www/html");

    $conn_id = ftp_connect(FTPHOST) or die("Couldn't connect to FTPHOST");
    ftp_login($conn_id, FTPUSER, FTPPASS);

/** This file is part of KCFinder project
  *
  *      @desc Upload calling script
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */

    require "core/bootstrap.php";
    // $uploader = "kcfinder\\uploader";  // To execute core/bootstrap.php on older
    $uploader = new $uploader();       // PHP versions (even PHP 4)
    $uploader->upload();

    $urlReturn = $uploader->filePath;
    // $urlLocal = str_replace("%20", " ", $urlReturn);
    $localPath = DOCUMENT_ROOT . $urlReturn;
    $ftp_path = str_replace(ROOT_PATH, "", $urlReturn);
    // $ftp_path = "/test.jpg";
    $upload = ftp_put($conn_id, $ftp_path, $localPath, FTP_BINARY);

?>