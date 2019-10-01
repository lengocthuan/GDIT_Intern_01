<?php
    // include database and object files
    require_once ('../config/database.php');
    require_once ('../objects/posts.php');
    
    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

    
?>

<?php
    $appPath = 'http://localhost/GDIT/app';
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
    <link rel="stylesheet" href="<?php echo $appPath . '/assets/css/createpost.css';?>">
    
    <script src="<?php echo $appPath . '/ckeditor/ckeditor.js';?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
</head>

<body>
    <form method="POST">
        <div class="title">
            <h2>Title <input class="input" type="text" placeholder="Input your post title" name="title" required></h2>
        </div>
        <div class="content">
            <textarea id="editor1" name="editor1" ></textarea>
            <script type="text/javascript">
                        CKEDITOR.replace( 'editor1', {
                            filebrowserUploadUrl: '/ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form',
     });
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
                    $stmt = $post->createPost($title, $editor1, $_SESSION['id']);

                    if ($stmt) {
                        echo "<font color='green'>Post has added successfully.";
                        echo "<br/><button><a href='./managementposts.php'>View Result</a></button>";
                    } else {
                        echo "<font color='red'>Post has not added.";
                        echo "<br/><button><a href='./managementposts.php'>Reload</a></button>";
                    }
                }
            }
        ?>
    </form>
</body>

</html>
