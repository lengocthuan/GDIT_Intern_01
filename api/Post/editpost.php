<?php
    require_once dirname(__DIR__) . "/config/config.php";
?>
<head>
    <title><?php echo EDIT; ?></title>
</head>
<?php
    require_once dirname(__DIR__) . "/common/header.php";
    require_once dirname(__DIR__) . "/objects/posts.php";

    // prepare post object
    $post = new Post($db);
?>
<body>
    <?php
        $id = $_GET['idpost'];

        $stmt = $post->editPost($id);

        while ($row = $stmt->fetch())
        {
            $idOld = $row['id'];
            $title = htmlspecialchars($row['title']);
            $content = htmlspecialchars($row['content']);
        }
    ?>
    <div>
        <h2 class="text-success text-center mt-3 mb-4">EDIT POST</h2>
    </div>
    <form method="POST">
        <table class="container table">
            <tr>
                <td>Title</td>
                <td><input class="input" type="text" placeholder="Input your post title" name="title" value="<?php echo $title;?>" required></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea id="editor1" name="editor1"><?php echo $content;?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="submit text-center btn btn-primary" type="submit" value="Apply change" name="change"></td>
            </tr>
        </table>
        <?php
            if (isset($_POST['change'])) {
                $newTitle = $_POST['title'];
                $newEditor = $_POST['editor1'];

                if ($newEditor == null) {
                    echo "<font color='red'>Content field is empty.</font><br/>";
                } else {
                    $stmt = $post->updatedPost($idOld, $newTitle, $newEditor, $_SESSION['id']);
                    if ($stmt) {
                        $_SESSION['updated'] = "Updated successfully for post $idOld";
                        header("Location: managementposts.php");
                    } else {
                        $_SESSION['ufailed'] = "Updated failed for post $idOld";
                        header("Location: managementposts.php");
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
