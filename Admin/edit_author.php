<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $cat_id = "";
    $cat_name = "";
    $query = "select * from authors where author_id = $_GET[cid]";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $author_name = $row['author_name'];
        $author_id = $row['author_id'];
    }

    if(isset($_POST['update_author'])){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "update authors set author_name = '$_POST[author_name]' where author_id = $_GET[cid]";
        $query_run = mysqli_query($connection,$query);
        header("location:manage_author.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    <span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
        <center><h4>Edit Author</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Author Name:</label>
                        <input type="text" class="form-control" name="author_name" value="<?php echo $author_name; ?>" required>
                    </div>
                    <button type="submit" name="update_author" class="btn btn-primary">Update Author</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>

