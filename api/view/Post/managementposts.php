<!-- <div id="results"><div> -->
<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/model.php";
    

    // prepare post object
    $model = new Model($db);

    // if (isset($_GET['pageno'])) {
    //         $pageno = $_GET['pageno'];
    // } else {
    //         $pageno = 1;
    // }
    // $no_of_records_per_page = 5;
    // $offset = ($pageno-1) * $no_of_records_per_page;

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
            <div id="target-content" >loading...</div>
            <div id="results">
            <?php require_once dirname(__DIR__,2) . "/config/pagination.php";
               // require_once 'showTable.php';
            ?>
            </div>
        </form>
    <script src="<?php echo LOCAL_PATH . '/assets/js/validate_checkbox.js' ;?>" type="text/javascript"></script>
    <script src="/assets/js/public_post.js"></script>
    <script type="text/javascript">var total_pages = "<?php echo $pages; ?>";</script>
    <script src="/assets/js/pagination.js">
    </script>
    <div class="table-responsive" id="pagination_data"></div>
    <!-- <div class="pagination"></div> -->
<!--     <div id="div_pagination">
        <input type="hidden" id="txt_rowid" value="0">
        <input type="hidden" id="txt_allcount" value="0">
        <input type="button" class="button" value="Previous" id="but_prev" />

        <input type="button" class="button" value="Next" id="but_next" />
    </div> -->
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
