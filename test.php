<!-- <?php
    // Way 1:
    // $partern = "/<title>([^<]*)<\/title>/im";
    // $subject = file_get_contents('template_for_user.html');
    // $replacement = '<title>thuanh123456dsome</title>';
    // file_put_contents('template_for_user.html', preg_replace($partern, $replacement, $subject));

?> -->
<form  method="POST" >
    <input type="checkbox" name="post[]" value="<?php echo $row['id'];?>"/>&nbsp;
    <button class="btn btn-primary" type="submit" name="submit" value="submit">Upload</button>

</form>
<?php 
    if (isset($_POST['submit'])) {
        if(!empty($_POST['post'])) {
            header("Location: ./api/Post/upload.php");
        }
    }