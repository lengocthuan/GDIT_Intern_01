<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/model.php";

    // prepare post object
    $model = new Model($db);

    $stmt = $model->index('posts', '', ['ORDER BY `updated_at` DESC']);

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
    <table class="container table table-border table-hover">
        <thead>
            <tr>
                <th class ="border-top" style = "vertical-align: middle;" rowspan="2">No.<i class="fas fa-sort-up"></i><i class="fas fa-sort-down"></i></th>
                <th class ="border-top" style = "vertical-align: middle;" rowspan="2">Post title</th>
                <th class="border-top center" colspan="5">
                        Information
                </th>
            </tr>
            <tr>
                <td class="width10">Edited</td>
                <td class="width10">Status</td>
                <td >Created at</td>
                <td >Publicized at</td>
                <td class="width15"><label><input type="checkbox" class="checkbox" id="checkAll">Check All</label></td>
            </tr>
        </thead>
        <tbody class="tbody">
            <?php
                $row = $stmt->fetchAll();
                if (!empty($row)){
                    foreach ($row as $value) {
            ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td class ="alignment-left">
                    <?php
                        if ($value['status'] == 3 || $value['status'] == 2) {
                            ?>
                            <a href="<?php echo PATH_GLOBAL_FTP . $value['path_in_global']; ?>"><?php echo htmlspecialchars($value['title']); ?></a>
                    <?php
                    } else {
                        echo htmlspecialchars($value['title']); 
                    }
                ?>
                </td>
                <td>
                    <a href="editpost.php?idpost=<?php echo $value['id'];?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class ="alignment-left">
                    <?php
                        switch ($value['status']) {
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
                <td>
                    <?php
                        if (is_null($value['created_at'])) {
                            echo 'updating...';
                        } else {
                            echo date_format(date_create($value['created_at']), 'd-m-Y H:m:s');
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($value['status'] == 3) {
                            echo date_format(date_create($value['publicized_at']), 'd-m-Y H:m:s');
                        } else {
                            echo 'updating...';
                        }
                    ?>
                </td>
                <td>
                    <input class ="checkbox" type="checkbox" name="post[]" value="<?php echo $value['id'];?>"/>&nbsp;
                </td>
            </tr>
            <?php
                    }
                } else {
            ?>
            <tr>
                <td colspan="7" style='color:grey;'><i>Data is empty. Please create a new post if you want.</i></td>
            </tr>
            <?php
                }

            ?>
        </tbody>
    </table>
    </form>
    <script src="<?php echo LOCAL_PATH . '/assets/js/validate_checkbox.js' ;?>" type="text/javascript"></script>
    <?php
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;
        
    ?>
</body>
</html>
<?php
    require_once dirname(__DIR__,2) . "/common/footer.php";
?>
