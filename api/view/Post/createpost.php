<head>
    <title><?php echo CREATE; ?></title>
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
<?php
    // include database and object files
    // require_once ('../config/database.php');
    require_once dirname(__DIR__,2) . "/common/header.php";
    require_once dirname(__DIR__,2) . "/common/generalFunction.php";

?>

</head>

<body onunload="onbeforeunload()">
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
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    <div>
        <h2 class="text-success text-center mt-3 mb-4">CREATE POST</h2>
    </div>
    <form method="POST" action="" id="create-post-form">
        <table class="container table">
            <tr>
                <td>Title</td>
                <td><input id="create-title" class="input" type="text" placeholder="Input your post title" name="title" ></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea id="editor1" name="editor1"></textarea></td>
            </tr>
            <!-- <tr>
                <td>Path</td>
                <td><input class="input" type="text" placeholder="Input your path for post" name="path" required hidden></td>
            </tr> -->
            <tr>
                <td></td>
                <td><input class="submit text-center btn btn-primary" type="submit" value="Save" name="create" id="save-post"></td>
            </tr>
        </table>
    </form>
    <script type="text/javascript" src="/assets/js/modal.js"></script>
    <script src='/assets/js/validate_create.js'></script>
</body>

</html>
<?php
    require_once dirname(__DIR__,2) . "/common/footer.php";
?>