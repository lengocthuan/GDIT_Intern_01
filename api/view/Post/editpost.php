<head>
    <title><?php echo EDIT; ?></title>
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
</head>
<?php
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/model/model.php";
?>
<body onunload="onbeforeunload()">
    <?php
        $model = new Model($db);

        if (isset($_GET['idpost'])) {
            $where = ['', 'id' => $_GET['idpost']];
            $stmt = $model->show('posts', ['title', 'content'], $where);
            if ($stmt) {
                while ($row = $stmt->fetch()) {
                    $title = htmlspecialchars($row['title']);
                    $content = $row['content'];
                }
            }
        }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Notification:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" role='alert'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    <div>
        <h2 class="text-success text-center mt-3 mb-4">EDIT POST</h2>
    </div>
    <form method="POST" id="edit-post" action="">
        <table class="container table">
            <tr>
                <input type="hidden" name="id_post" value="<?php echo $_GET['idpost']; ?>">
                <td>Title</td>
                <td><input id="edit-title" class="input" type="text" placeholder="Input your post title" name="title" value="<?php echo $title;?>" required></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea id="editor1" name="editor1"><?php echo $content;?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="submit text-center btn btn-primary" type="submit" value="Apply change" name="update" id="apply-change"></td>
            </tr>
        </table>
    </form>
    <script src="/assets/js/modal.js"></script>
    <script src="/assets/js/validate_edit.js"></script>
</body>
</html>
<?php
    require_once dirname(__DIR__,2) . "/common/footer.php";
?>
