<!-- <div id="results"><div> -->
<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/model.php";
    include_once dirname(__DIR__,2) . "/config/pagination.php";

    // prepare post object
    $model = new Model($db);

    // if (isset($_GET['pageno'])) {
    //         $pageno = $_GET['pageno'];
    // } else {
    //         $pageno = 1;
    // }
    // $no_of_records_per_page = 5;
    // $offset = ($pageno-1) * $no_of_records_per_page;

//     if (isset($_POST['page'])) {
//         $page_number = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
//         if (!is_numeric($page_number)) {die('Invalid page number!');} //incase of invalid page number
//     } else {
//         $page_number = 1;
//     }

// //get current starting point of records
//     // var_dump($_POST['page']);
//     $position = (($page_number - 1) * $no_of_records_per_page);

    // $total_records = 0;
    // $count_total = $model->index('posts', '', '');

    // $records = $count_total->fetchAll();
    // // var_dump($row); die();
    // if ($records > 0) {
    //     $total_records = count($records);
    // }

    // // 1 2 3 4 5 (total = 20 , per_page = 4 records)
    // $pages = ceil($total_records/$no_of_records_per_page);

    // var_dump($position);
    // //$position get current starting point of records
    // $stmt = $model->index('posts', '', ["ORDER BY `updated_at` DESC LIMIT $position, $no_of_records_per_page"]);
    // echo '458'; die();
    // $row = $stmt->fetchAll();
    // var_dump($position);

?>
<body>
    <div>
        <h2>Posts Management</h2>
    </div>
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
                <button id="public-post" class="btn btn-primary" type="submit" name="upload" value="upload" data-toggle="tooltip" title="Upload"><i class="fas fa-cloud-upload-alt"></i></button>
                <button class="btn btn-danger" type="submit" name="remove" value="remove" onclick="return submitForm()" data-toggle="tooltip" title="Remove"><i class="fas fa-trash-alt"></i></button>
                <!-- <button class="btn btn-warning" type="submit" name="restore" value="restore" data-toggle="tooltip" title="Restore"><i class="fas fa-trash-restore-alt"></i></button> -->
            </div>
            <div id="results"></div>
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
                <div id="results"></div>
                <tbody class="tbody">
                    <?php
                        // var_dump($row);
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
            <!-- <div id="results"></div> -->
        </form>
    <script src="<?php echo LOCAL_PATH . '/assets/js/validate_checkbox.js' ;?>" type="text/javascript"></script>
    <script src="/assets/js/public_post.js"></script>
    <script type="text/javascript">var total_pages = "<?php echo $pages; ?>";</script>
    <script src="/assets/js/pagination.js">
    </script>
    
    <div class="pagination"></div>
<!--     <?php
        // $query = "SELECT count(*) FROM posts";
        // $sth = $db->prepare($query);
        // // var_dump($sth); die();
        // if ($sth->execute()) {
        //     $total = $sth->fetchAll();
        //     foreach ($total as $value) {
        //         $total_records = $value[0];
        //     }
        //     $total_pages = ceil($total_records/$no_of_records_per_page);
        // }
        //     $panigate = "<ul class='pagination'>";
        //     for ($i=1; $i<=$total_pages; $i++) {
        //      if ($total_pages == 1) {
        //          break;
        //      }
        //      $panigate .= "<li class='page-item'><a class='page-link' href='managementposts.php?pageno=".$i."'>".$i."</a></li>";  
        //     }
        //     echo $panigate . "</ul>";
    ?> -->
</body>
</html>
<?php
    require_once dirname(__DIR__,2) . "/common/footer.php";
?>
