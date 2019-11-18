<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="shortcut icon" type="image/png" href="assets/favicon.png"/>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/signup.css">
        <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
        <script src="assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <?php
            require_once dirname(__FILE__) . '/api/config/config.php';
            // require_once dirname(__FILE__) . '/api/controller/UsersController.php';
            session_start();
            if (isset($_SESSION['login_fail'])) {
            ?>
            <div class='alert alert-warning alert-dismissible' role='alert'>
                <a href='#'  class="close" data-dismiss="alert" aria-label="Close">&times;</a>
                <strong><?php echo $_SESSION['login_fail']; ?></strong>
            </div>
            <?php
                unset($_SESSION['login_fail']);
            }
            if (isset($_SESSION['id'])) {
                header('Location: ' . LOCAL_PATH . HOME);
            }
            ?>
        </div>
        <div class="login-wrap">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab" >Sign Up</label>
                <div class="login-form">
                    <form method="POST" class="sign-in-htm" action="<?php echo LOCAL_PATH . USERS_C;?> ">
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="username" name="username" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <div class="col-md-24">
                                <input id="password-field-login" type="password" class="input" name="password">
                                <span class="show-passwd"><i toggle="#password-field-login" class="fas fa-eye-slash toggle-password"></i></span>
                            </div>
                        </div>
                        <div class="group">
                            </br>
                            <input type="submit" name="login" class="button" value="Sign In">
                        </div>
                    </form>
                    <!-- onsubmit="return checkForm(this);" -->
                    <form class="sign-up-htm" method="POST">
                        <!-- <div id="error_msg"></div> -->
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="username-sign-up" name="username" type="text" class="input">
                            <span></span>
                        </div>
                        <div class="group">
                            <label for="pass" class="label" >
                                <span>Password</span>
                                <div class="tooltip">
                                    <i class="fas fa-question"></i>
                                    <span class="tooltiptext text-pop-up-top">
                                        <i class="fas fa-check-circle space-line">Matches a string of six or more characters;</i><br />
                                        <i class="fas fa-check-circle space-line">That contains at least one digit (is short hand for [0-9]);</i><br />
                                        <i class="fas fa-check-circle space-line">At least one lowercase character;</i><br />
                                        <i class="fas fa-check-circle space-line">At least one uppercase character</i><br />
                                    </span>
                                </div>
                            </label>
                            <div class="col-md-24">
                                <input id="password-field" type="password" class="input" name="password">
                                <span class="show-passwd"><i toggle="#password-field" class="fas fa-eye-slash toggle-password"></i></span>
                            </div>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Confirm Password</label>
                            <div class="col-md-24">
                                <input id="password-field-confirm" type="password" class="input" name="password_confirm">
                                <span toggle="#password-field-confirm" class="show-passwd"><i toggle="#password-field-confirm" class="fas fa-eye-slash toggle-password-confirm"></i></span>
                            </div>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up" name="sign_up" id="sign_up">
                        </div>
                        <div class="foot-lnk">
                            <label for="tab-1">Already Member?</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/validate_signin.js"></script>
    <script src="assets/js/validate_signup.js"></script>
</body>
</html>