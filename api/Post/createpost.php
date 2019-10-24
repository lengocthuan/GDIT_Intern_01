<?php
    require_once dirname(__DIR__) . "/config/config.php";
?>
<head>
    <title><?php echo CREATE; ?></title>
</head>
<?php
    // include database and object files
    // require_once ('../config/database.php');
    require_once dirname(__DIR__) . "/common/header.php";
    require_once dirname(__DIR__) . "/objects/posts.php";
    require_once dirname(__DIR__) . "/common/generalFunction.php";

    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

?>
<body>
    <div>
        <h2 class="text-success text-center mt-3 mb-4">CREATE POST</h2>
    </div>
    <form method="POST">
        <table class="container table">
            <tr>
                <td>Title</td>
                <td><input class="input" type="text" placeholder="Input your post title" name="title" required></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea id="editor1" name="editor1"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="submit text-center btn btn-primary" type="submit" value="Save" name="save"></td>
            </tr>
        </table>
        <?php
            if (isset($_POST['save'])) {
                $title = trim($_POST['title']);
                $editor1 = $_POST['editor1'];

                if ($_POST['editor1'] == null) {
                    echo "<font color='red'>Content field is empty.</font><br/>";
                } else {
                    $stmt = $post->createPost($title, $editor1, $_SESSION['id']);

                    if ($stmt) {
                        echo "<font color='green'>Post has added successfully.";
                        echo "<br/><button><a href='managementposts.php'>View Result</a></button>";
                    } else {
                        echo "<font color='red'>Post has not added.";
                        echo "<br/><button><a href='managementposts.php'>Reload</a></button>";
                    }
                }
            }
        ?>
    </form>
</body>

</html>
<?php
    require_once dirname(__DIR__) . "/common/footer.php";
?>