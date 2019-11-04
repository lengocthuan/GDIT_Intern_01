<head>
    <title><?php echo EDIT; ?></title>
</head>
<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/model.php";
?>
<body>
    <?php
        $model = new Model($db);

        if (isset($_GET['idpost'])) {
            $where = ['', 'id' => $_GET['idpost']];
            $stmt = $model->show('posts', ['title', 'content'], $where);
            if ($stmt) {
                while ($row = $stmt->fetch()) {
                    $title = $row['title'];
                    $content = $row['content'];
                }
            }
        }

    ?>
    <div>
        <h2 class="text-success text-center mt-3 mb-4">EDIT POST</h2>
    </div>
    <form method="POST" action="<?php echo LOCAL_PATH . POSTS_C;?>">
        <table class="container table">
            <tr>
                <input type="hidden" name="id_post" value="<?php echo $_GET['idpost']; ?>">
                <td>Title</td>
                <td><input class="input" type="text" placeholder="Input your post title" name="title" value="<?php echo $title;?>" required></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea id="editor1" name="editor1"><?php echo $content;?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="submit text-center btn btn-primary" type="submit" value="Apply change" name="update"></td>
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
    require_once dirname(__DIR__,2) . "/common/footer.php";
?>
