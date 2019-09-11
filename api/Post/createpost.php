<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/post.php';

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
    <title>Create a new post</title>
    <link rel="stylesheet" prefetch href="https://fonts.googleapis.com/css?family=Open+Sans:600">
    <link rel="stylesheet" href="../../assets/css/createpost.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
</head>

<body>
    <form method="POST">
        <div class="title">
            <h2>Title <input class="input" type="text" placeholder="Input your post title" name="title" required></h2>
        </div>
        <div class="content">
            <textarea class="editor1" name="editor1" ></textarea>
            <script>
                CKEDITOR.replace('editor1');
            </script>
            </br>
        </div>
        <button class="submit" type="submit" name="submit">Save</button>
        <?php
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $editor1 = $_POST['editor1'];

                if ($_POST['editor1'] == null) {
                    echo "<font color='red'>Content field is empty.</font><br/>";
                } else {
                    $stmt = $post->createPost();

                    echo "<font color='green'>Post has added successfully.";
                    echo "<br/><button><a href='./managementposts.php'>View Result</a></button>";
                }

            }
        ?>
    </form>

</body>

</html>
