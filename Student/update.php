<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $query = "update students set first_name = '$_POST[first_name]', last_name = '$_POST[last_name]', postal_address = '$_POST[address]',email_address = '$_POST[email]',phone_number = '$_POST[mobile]'";
    $query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
    alert("Updated successfully...");
    window.location.href = "student_dashboard.php";
</script>
