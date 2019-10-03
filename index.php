<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div>
        <?php
            session_start();

            if (isset($_SESSION['failed'])) {
                ?>
                <div class='alert alert-warning alert-dismissible' role='alert'>
                        <a href='#'  class="close" data-dismiss="alert" aria-label="Close">&times;</a>
                        <strong><?php echo $_SESSION['failed']; ?></strong>
                </div>
                <?php
                unset($_SESSION['failed']);
            }
        ?>
    </div>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <form class="sign-in-htm" action="./api/User/login.php" method="GET">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="username" name="username" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="password" name="password" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign In">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                </form>
                <form class="sign-up-htm" action="#" method="POST">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="username" name="username" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="password" name="password" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Confirm Password</label>
                        <input id="pass" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign Up">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <script src="/GDIT/app/assets/js/jquery.min.js"></script>
  <script src="/GDIT/app/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>