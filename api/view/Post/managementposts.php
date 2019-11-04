<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/posts.php";
    require_once dirname(__DIR__,2) . "/model/paginatepage.php";

    // prepare post object
    $post = new Post($db);

    $stmt = $post->managementPost();

?>
<body>
    <div>
        <h2>Posts Management</h2>
    </div>
    <p>
        <?php
            if (isset($_SESSION['successful'])) {
                ?>
                <div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong><?php echo $_SESSION['successful']; ?></strong>
                </div>
                <?php
                unset($_SESSION['successful']);
            }
        ?>
    </p>
    <p>
        <?php
            if (isset($_SESSION['rmsuccessful'])) {
                ?>
                <div class='alert alert-info alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong><?php echo $_SESSION['rmsuccessful']; ?></strong>
                </div>
                <?php
                unset($_SESSION['rmsuccessful']);
            }
        ?>
    </p>
    <p>
        <?php
            if (isset($_SESSION['updated'])) {
                ?>
                <div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong><?php echo $_SESSION['updated']; ?></strong>
                </div>
                <?php
                unset($_SESSION['updated']);
            }
            if (isset($_SESSION['ufailed'])) {
                ?>
                <div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong><?php echo $_SESSION['ufailed']; ?></strong>
                </div>
                <?php
                unset($_SESSION['ufailed']);
            }
        ?>
    </p>
    <p>
        <?php
            if (isset($_SESSION['not_exist'])) {
                ?>
                <div class='alert alert-info alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong><?php echo $_SESSION['not_exist']; ?></strong>
                </div>
                <?php
                unset($_SESSION['not_exist']);
            }
        ?>
    </p>
    <form method="POST" id="form" action="<?php echo LOCAL_PATH . POSTS_C;?>">
    <div class = "container createpost" >
        <a href="createpost.php" class="btn btn-success" role="button" data-toggle="tooltip" title="Create"><i class="fas fa-plus-square"></i></a>
        <button class="btn btn-primary" type="submit" name="upload" value="upload" onclick="return submitForm()" data-toggle="tooltip" title="Upload"><i class="fas fa-cloud-upload-alt"></i></button>
        <button class="btn btn-danger" type="submit" name="remove" value="remove" onclick="return submitForm()" data-toggle="tooltip" title="Remove"><i class="fas fa-trash-alt"></i></button>
        <!-- <button class="btn btn-warning" type="submit" name="restore" value="restore" data-toggle="tooltip" title="Restore"><i class="fas fa-trash-restore-alt"></i></button> -->
    </div>
    <table class="container table table-border" >
        <tr>
            <th class ="border-top" rowspan="2">No.</th>
            <th class ="border-top" rowspan="2">Post title</th>
            <th class="border-top center" colspan="3">
                    Status
            </th>
        </tr>
        <tr>
                <td class="width10">Edited</td>
                <td class="width15"><label><input type="checkbox" class="checkbox" id="checkAll">Check All</label></td>
                <td class="width10">Information</td>
        </tr>
        <tbody class="tbody">
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class ="alignment-left">
                    <?php
                        if ($row['status'] == 3) {
                            ?>
                            <a href="<?php echo PATH_GLOBAL_FTP . $row['id'] . $row['path_in_global']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                    <?php
                    } else {
                        echo htmlspecialchars($row['title']); 
                    }
                ?>
                </td>
                <td>
                    <a href="editpost.php?idpost=<?php echo $row['id'];?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <input class ="checkbox" type="checkbox" name="post[]" value="<?php echo $row['id'];?>"/>&nbsp;
                </td>
                <td class ="alignment-left">
                    <?php
                        switch ($row['status']) {
                            case 1:
                                echo C; //The post has been created.
                                break;
                            case 2:
                                echo U; //The post has been edited after uploaded;
                                break;
                            case 3:
                                echo P; //The post has been uploaded to the latest version.
                                break;
                            default:
                                # code...
                                break;
                        }
                    ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </form>
    <script src="<?php echo LOCAL_PATH . '/assets/js/validate_checkbox.js' ;?>" type="text/javascript"></script>
</body>
<!-- <?php
        // if (isset($_POST['submit']) || isset($_POST['remove'])) {
        //     if(!empty($_POST['post'])){
        //         // Loop to store and display values of individual checked checkbox.
        //             foreach($_POST['post'] as $selected){
        //                 $checkList[] = $selected;
        //             }
        //             $_SESSION['checkList'] = $checkList;
        //             if (isset($_POST['submit'])) {
        //                 header("Location: upload.php");
        //             } else {
        //                 header("Location: removepost.php");
        //             }
        //     }
        // }
?> -->
<?php
    $stmt = $post->getTotalRecord();

    $config = [
        'total' => $stmt,
        'limit' => 5,
        'full' => false,
        'querystring' => 'page'
    ];
    
    $page = new Pagination($config);

    echo $page->getPagination();
?>
</html>

<?php
    require_once dirname(__DIR__) . "/common/footer.php";
?>
