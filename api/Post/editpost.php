<?php
    // include database and object files
    require_once '../config/database.php';
    require_once '../objects/posts.php';

    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

?>

<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        $message = 'You must be logged in to access this page';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit a post</title>
    <link rel="stylesheet" prefetch href="https://fonts.googleapis.com/css?family=Open+Sans:600">
    <link rel="stylesheet" href="../../assets/css/createpost.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
</head>

<body>
    <?php
        $id = $_GET['idpost'];

        $stmt = $post->editPost($id);

        while ($row = $stmt->fetch())
        {
            $idOld = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
        }
    ?>
        <form method="POST">
        <div class="title">
            <h2>Title <input class="input" type="text" placeholder="Input your post title" name="title" required value="<?php echo $title; ?>"></h2>
        </div>
        <div class="content">
            <textarea class="editor1" name="editor1"><?php echo $content; ?></textarea>
            <script>
                CKEDITOR.replace('editor1');
            </script>
            </br>
        </div>
        <button class="submit" type="submit" name="submit">Apply change</button>
        <?php
            if (isset($_POST['submit'])) {
                $newTitle = $_POST['title'];
                $newEditor1 = $_POST['editor1'];

                if ($_POST['editor1'] == null) {
                    echo "<font color='red'>Content field is empty.</font><br/>";
                } else {
                    // print_r($idOld." ". $newTitle." ". $newEditor1);
                    $stmt = $post->updatedPost($idOld, $newTitle, $newEditor1, $_SESSION['id']);

                    if ($stmt) {
                        echo "<font color='green'>Post has updated successfully.";
                        // header("Location: ./managementposts.php");
                        echo "<script type='text/javascript'>alert('Wrong Username or Password');window.location='./managementposts.php';</script>";
                    } else {
                        echo "<font color='red'>Post has not updated successfully.";
                        echo "<br/><button><a href='./managementposts.php'>Reload Management Post</a></button>";
                    }
                }
            }
        ?>

    </form>

</body>

</html>
