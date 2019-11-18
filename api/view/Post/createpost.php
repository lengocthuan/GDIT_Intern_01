<head>
    <title><?php echo CREATE; ?></title>
</head>
<?php
    // include database and object files
    // require_once ('../config/database.php');
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/common/generalFunction.php";

?>
<body>
    <div>
        <h2 class="text-success text-center mt-3 mb-4">CREATE POST</h2>
    </div>
    <p>
        <?php
            if (isset($_SESSION['null'])) {
                ?>
                <div class='alert alert-info alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong><?php echo $_SESSION['null']; ?></strong>
                </div>
                <?php
                unset($_SESSION['null']);
            }
        ?>
    </p>
    <form method="POST" action="<?php echo LOCAL_PATH . POSTS_C;?>">
        <table class="container table">
            <tr>
                <td>Title</td>
                <td><input class="input" type="text" placeholder="Input your post title" name="title" required></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea id="editor1" name="editor1"></textarea></td>
            </tr>
            <!-- <tr>
                <td>Path</td>
                <td><input class="input" type="text" placeholder="Input your path for post" name="path" required hidden></td>
            </tr> -->
            <tr>
                <td></td>
                <td><input class="submit text-center btn btn-primary" type="submit" value="Save" name="create"></td>
            </tr>
        </table>
    </form>
</body>

</html>
<?php
    require_once dirname(__DIR__,2) . "/common/footer.php";
?>