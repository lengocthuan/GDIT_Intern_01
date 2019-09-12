<?php
// include database and object files
    include_once '../config/database.php';
    include_once '../objects/post.php';

    session_start();
    // get database connection
    $database = new Database();

    $db = $database->getConnection();

    // prepare post object
    $post = new Post($db);

    $stmt = $post->managementPost();

    // while ($row = $stmt->fetch()) {
    //     $id = $row['id'];
    //     $title = $row['title'];
    //     $id = $row['id'];
    //     $id = $row['id'];
    // }
?>
<head>
    <meta charset="UTF-8">
    <title>Management Posts</title>
    <link rel="stylesheet" prefetch href="https://fonts.googleapis.com/css?family=Open+Sans:600">
    <link rel="stylesheet" href="../../assets/css/posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
</head>

<body>

    <div class="manage">
        <h2>Posts Management</h2>
    </div>

    <table>
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Post title</th>
            <th class="center" colspan="3">
                    Status
                
            </th>
        </tr>
        <tr>
                <td>Created</td>
                <td>Edited</td>
                <td>Publicized</td>
        </tr>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']) ?></td>
                <td><?php echo htmlspecialchars($row['title']) ?></td>
                <td><i class="fas fa-file-alt"></i></td>
                <td>
                        <a href="./editpost.php?<?php echo $row['id'];?>">
                            <i class="fas fa-edit"></i>
                        </a>
                </td>
                <td><i class="fas fa-globe"></i></td>
            </tr>
            <?php endwhile; ?>
            <tr class="newPost">
                <td class="hide"></td>
                <td class="hide"></td>
                <td class="hide"></td>
                <td class="hide"></td>
                <td class="create">
                    <form class="submit" action="../Post/createpost.php" method="get" style="margin-bottom: 0 !important;">
                      <input type="submit" value="Create a new post">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
