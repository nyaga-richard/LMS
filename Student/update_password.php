<?php
    session_start();
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $password = "";
    $query = "select * from students where email_address = '$_SESSION[email]'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $password = $row['password'];
    }
    if($password == $_POST['new_password']){
        $query = "update admins set password = '$_POST[new_password]' where email = '$_SESSION[email]'";
        $query_run = mysqli_query($connection,$query);
        ?>
        <script type="text/javascript">
            alert("Updated successfully...");
            window.location.href = "student_dashboard.php";
        </script>
        <?php
    }
    else{
        ?>
        <script type="text/javascript">
            alert("Wrong Admin Password...");
            window.location.href = "change_password.php";
        </script>
        <?php
    }
?>
