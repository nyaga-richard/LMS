<?php
    session_start();
    if(isset($_POST['login'])){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "select * from students where email_address = '$_POST[email]'";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            if($row['email_address'] == $_POST['email']){
                if($row['password'] == $_POST['password']){
                    $_SESSION['name'] =  $row['first_name'];
                    $_SESSION['email'] =  $row['email_address'];
                    header("Location: Student/student_dashboard.php");
                }
                else{
                    ?>
                    <br><br><center><span class="alert-danger">Wrong Password !!</span></center>
                    <?php
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<style type="text/css">
    #main_content{
        background: rgba(245, 245, 245, 0.9);
        padding: 50px;
    }
    #side_bar{
        background: rgba(245, 245, 245, 0.9);
        padding: 50px;
    }
    body{
      background: rgba(245, 245, 245, 0.4);
      background-image: url("https://img.freepik.com/free-photo/abundant-collection-antique-books-wooden-shelves-generated-by-ai_188544-29660.jpg?size=626&amp;ext=jpg&amp;ga=GA1.1.1546980028.1704240000&amp;semt=sph");
   }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Library Management System</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">User Login</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_login.php">Admin Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="student_login.php">Student Login</a>
              </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-4" id="side_bar">
            <h5>Today's Quote</h5>
            <h6>“There is more treasure in books than in all the pirate's loot on Treasure Island"</h6>
            <p>~ Walt Disney</p>
            <h5>Library Timing</h5>
            <ul>
                <li>Opening: 9:00 AM</li>
                <li>Closing: 12:00 PM</li>
            </ul>
            <h5>What We provide ?</h5>
            <ul>
                <li>AC Rooms</li>
                <li>Free Wi-fi</li>
                <li>Learning Environment</li>
                <li>Discussion Room</li>
                <li>Free Electricity</li>
            </ul>
        </div>
        <div class="col-md-8" id="main_content">
            <center><h3><u>Student Login Form</u></h3></center>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>   
            </form>

        </div>
    </div>
</body>
</html>
