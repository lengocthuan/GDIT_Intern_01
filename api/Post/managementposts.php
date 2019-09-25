<?php
    // include database and object files
    require_once ('../config/database.php');
    require_once ('../objects/posts.php');
    require_once ('../objects/paginatepage.php');

    session_start();
    ob_start();
    // get database connection
    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

    $stmt = $post->managementPost();

?>
<head>
    <meta charset="UTF-8">
    <title>Management Posts</title>
    <link rel="stylesheet" prefetch href="https://fonts.googleapis.com/css?family=Open+Sans:600">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include('../../header.html'); ?>
    <?php
            if (!empty($_SESSION['message'])) {
                echo '<script type="text/javascript"> alert("Remove successful"); </script>';
            }
    ?>
    <div class="manage">
        <h2>Posts Management</h2>
    </div>
    <p>
        <?php
            if (isset($_SESSION['successful'])) {
                echo "<div class='alert alert-success alert-dismissible'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Successful upload.</strong>
                        </div>";
                unset($_SESSION['successful']);
            }
        ?>
    </p>
    <form method="POST">
    <table>
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Post title</th>
            <th class="center" colspan="4">
                    Status
            </th>
        </tr>
        <tr>
                <td>Created</td>
                <td>Edited</td>
                <td>Publicized</td>
                <td>Delete</td>
        </tr>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']) ?></td>
                <td><?php echo htmlspecialchars($row['title']) ?></td>
                <td><i class="fas fa-file-alt"></i></td>
                <td>
                    <a href="./editpost.php?idpost=<?php echo $row['id'];?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <input type="checkbox" name="post[]" value="<?php echo $row['id'];?>"/>&nbsp;
                </td>
                <td>
                    <a href="./removepost.php?idpost=<?php echo $row['id'];?>" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <div class = "createpost">
            <a href="createpost.php" class="btn btn-success" role="button">Create</a>
            <button class="btn btn-primary" type="submit" name="submit" value="submit">Upload</button>
    </div>
    </form>
    
</body>
<?php
        if (isset($_POST['submit'])) {
            if(!empty($_POST['post'])){
            // Loop to store and display values of individual checked checkbox.
                foreach($_POST['post'] as $selected){
                    $checkList[] = $selected;
                }
                $_SESSION['checkList'] = $checkList;
                header("Location: upload.php");
            }
        }
    ?>
<?php
    $stmt = $post->getTotalRecord();

    $config = [
        'total' => $stmt,
        'limit' => 5,
        'full' => false,
        'querystring' => 'trang'
    ];
    
    $page = new Pagination($config);

    echo $page->getPagination();
?>
</html>
