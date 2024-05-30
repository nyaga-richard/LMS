<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $cat_id = "";
    $cat_name = "";
    $query = "select * from category where cat_id = $_GET[cid]";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $cat_name = $row['cat_name'];
        $cat_id = $row['cat_id'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    </nav><br>
    <span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
        <center><h4>Edit Book</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input type="text" class="form-control" name="cat_name" value="<?php echo $cat_name; ?>" required>
                    </div>
                    <button type="submit" name="update_cat" class="btn btn-primary">Update Catogry</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>
<?php
    if(isset($_POST['update_cat'])){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "update category set cat_name = '$_POST[cat_name]' where cat_id = $_GET[cid]";
        $query_run = mysqli_query($connection,$query);
        header("location:manage_cat.php");
    }
?>
