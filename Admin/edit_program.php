<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['program_id'])) {
    $program_id = $_GET['program_id'];
    $query = "SELECT * FROM computer_programs WHERE program_id = '$program_id'";
    $result = mysqli_query($connection, $query);
    $program = mysqli_fetch_assoc($result);

    if (!$program) {
        echo "<script>alert('Program not found'); window.location.href = 'manage_programs.php';</script>";
        exit;
    }
}

if (isset($_POST['update_program'])) {
    $program_id = $_POST['program_id'];
    $program_name = $_POST['program_name'];
    $version = $_POST['version'];
    $installed_on = $_POST['installed_on'];

    $query = "UPDATE computer_programs SET 
                program_name = '$program_name', 
                version = '$version', 
                installed_on = '$installed_on' 
              WHERE program_id = '$program_id'";
    
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Program updated successfully'); window.location.href = 'manage_programs.php';</script>";
    } else {
        echo "<script>alert('Error updating program');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Program</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Edit Program</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['program_id']); ?>">
                <div class="form-group">
                    <label for="program_name">Program Name:</label>
                    <input type="text" name="program_name" class="form-control" value="<?php echo htmlspecialchars($program['program_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="version">Version:</label>
                    <input type="text" name="version" class="form-control" value="<?php echo htmlspecialchars($program['version']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="installed_on">Installed On (Computer ID):</label>
                    <input type="text" name="installed_on" class="form-control" value="<?php echo htmlspecialchars($program['installed_on']); ?>" required>
                </div>
                <button type="submit" name="update_program" class="btn btn-primary">Update Program</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
