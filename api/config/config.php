<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    //define paths
    define('HOST', 'http://managementpage.gdit.vn');
    define('ORIGINAL', '/var/www/html');
    define('LOCAL_ORIGINAL', '/var/www/html/GDIT/app');
    define('LOCAL_PATH','http://managementpage.gdit.vn');
    define('PATH_GLOBAL', '/global/');
    define('IMAGES_GLOBAL', '/global/images/');
    define('PATH_GLOBAL_FTP', 'http://publicpage.gdit.vn');
    define('IMAGE_LOCAL_P', '/ckeditor/kcfinder/upload/images/');
    // define('IMAGE_LOCAL_P', '/GDIT/app/ckeditor/kcfinder/upload/images/');
    define('POSTS_C', '/api/controller/PostsController.php');
    define('USERS_C', '/api/controller/UsersController.php');

    //status
    define('C', 'Created');
    define('U', 'Updating');
    define('P', 'Publicized');

    //define name of every page
    define('MANAGE', 'Management Posts');
    define('CREATE', 'Create A Post');
    define('EDIT', 'Edit A Post');
    define('PUBLISH', 'Publish Posts');
    define('REMOVE', 'Remove A Post');

    //define router view for website
    // define ('LOGIN', '/api/view/User/login.php');
    define ('LOGOUT', '/api/view/User/logout.php');
    define ('HOME', '/api/view/Post/managementposts.php');
    define ('P_CREATE', '/api/view/Post/createpost.php');
    define ('P_EDIT', '/api/view/Post/editpost.php');
    define ('REMOVE_POST', '/api/view/Post/removepost.php');
    define ('PUBLIC_POST', '/api/view/Post/upload.php');

    //define config database environment
    define ('ENV_HOST', 'localhost');
    define ('ENV_DB_NAME', 'GDIT_Intern_01');
    define ('ENV_USERNAME', 'root');
    define ('ENV_PASSWD', 'thuan');

    //define config ftp environment
    define ('FTP_HOST', '127.0.0.1');
    define ('FTP_USERNAME', 'ftp_gdit_01');
    define ('FTP_PASSWD', 'thuan');

    //define table database name
    define('USERS', 'users');
    define('POSTS', 'posts');

    //define replacement update path after save image from kcfinder server to local server
    define('SRC_REP','src="/var/www/html/GDIT/app');

    //define number records of per page
    $no_of_records_per_page = 3;