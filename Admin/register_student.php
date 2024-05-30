<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['register_student'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $postal_address = $_POST['postal_address'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $university_registered = isset($_POST['university_registered']) ? 1 : 0;

    $query = "INSERT INTO students (first_name, last_name, postal_address, email_address, phone_number, university_registered, password) 
              VALUES ('$first_name', '$last_name', '$postal_address', '$email_address', '$phone_number', '$university_registered', '$password')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Student registered successfully'); window.location.href = 'manage_students.php';</script>";
    } else {
        echo "<script>alert('Error registering student');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Student</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <center><h4>Register Student</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="postal_address">Postal Address:</label>
                    <input type="text" name="postal_address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email_address">Email Address:</label>
                    <input type="email" name="email_address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Password:</label>
                    <input type="text" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="university_registered">University Registered:</label>
                    <input type="checkbox" name="university_registered">
                </div>
                <button type="submit" name="register_student" class="btn btn-primary">Register Student</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
