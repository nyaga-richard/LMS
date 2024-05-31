<?php
    
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $name = "";
    $email = "";
    $mobile = "";
    $query = "select * from students where email_address = '$_SESSION[email]'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $address = $row['postal_address'];
        $email = $row['email_address'];
        $mobile = $row['phone_number'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    <span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
        <center><h4>Student Profile Detail</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form>
                    <div class="form-group">
                        <label for="name">First Name:</label>
                        <input type="text" class="form-control" value="<?php echo $first_name;?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name:</label>
                        <input type="text" class="form-control" value="<?php echo $last_name;?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Postal Address:</label>
                        <input type="text" class="form-control" value="<?php echo $address;?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" value="<?php echo $email;?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" value="<?php echo $mobile;?>" class="form-control" disabled>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>
