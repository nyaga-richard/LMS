<?php
    require("functions.php");
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $name = "";
    $email = "";
    $mobile = "";
    $query = "select * from admins where email = '$_SESSION[email]'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
    }
   
    if(isset($_POST['add_author']))
    {
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "insert into authors values('','$_POST[author_name]')";
        $query_run = mysqli_query($connection,$query);
        header("Location:admin_dashboard.php");
    }

?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
    <script type="text/javascript">
          function alertMsg(){
              alert(Author added successfully...);
              window.location.href = "admin_dashboard.php";
          }
      </script>
    </head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>

    <center><h4>Add a new Author</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Author Name:</label>
                        <input type="text" class="form-control" name="author_name" required>
                    </div>
                    <button type="submit" name="add_author" class="btn btn-primary">Add Author</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>

