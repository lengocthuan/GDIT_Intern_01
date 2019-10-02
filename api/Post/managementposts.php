<?php
    require_once dirname(__DIR__) . "/common/header.php";
    require_once dirname(__DIR__) . "/objects/posts.php";
    require_once dirname(__DIR__) . "/objects/paginatepage.php";

    // prepare post object
    $post = new Post($db);

    $stmt = $post->managementPost();

?>

<body>
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
            <th class="center" colspan="3">
                    Status
            </th>
        </tr>
        <tr>
                <td>Edited</td>
                <td>Publicized</td>
                <td>Delete</td>
        </tr>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
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
