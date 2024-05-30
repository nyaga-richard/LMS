<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['add_program'])) {
    $program_name = $_POST['program_name'];
    $version = $_POST['version'];
    $installed_on = $_POST['installed_on'];

    $query = "INSERT INTO computer_programs (program_name, version, installed_on) VALUES ('$program_name', '$version', '$installed_on')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Program added successfully'); window.location.href = 'manage_programs.php';</script>";
    } else {
        echo "<script>alert('Error adding program');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Program</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Add Program</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="program_name">Program Name:</label>
                    <input type="text" name="program_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="version">Version:</label>
                    <input type="text" name="version" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="installed_on">Installed On (Computer ID):</label>
                    <input type="text" name="installed_on" class="form-control" required>
                </div>
                <button type="submit" name="add_program" class="btn btn-primary">Add Program</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
