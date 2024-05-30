<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['update_computer'])) {
    $computer_id = $_POST['computer_id'];
    $computer_name = $_POST['computer_name'];
    $status = $_POST['status'];
    $location = $_POST['location'];

    $query = "UPDATE computers SET 
                computer_name = '$computer_name', 
                status = '$status', 
                location = '$location' 
              WHERE computer_id = '$computer_id'";
    
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Computer updated successfully'); window.location.href = 'manage_computers.php';</script>";
    } else {
        echo "<script>alert('Error updating computer');</script>";
    }
}

$computer_id = isset($_GET['computer_id']) ? $_GET['computer_id'] : null;

if (!$computer_id) {
    echo "<script>alert('No computer ID provided'); window.location.href = 'manage_computers.php';</script>";
    exit;
}

$query = "SELECT * FROM computers WHERE computer_id = '$computer_id'";
$result = mysqli_query($connection, $query);
$computer = mysqli_fetch_assoc($result);

if (!$computer) {
    echo "<script>alert('Computer not found'); window.location.href = 'manage_computers.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Computer</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Edit Computer</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="computer_id" value="<?php echo htmlspecialchars($computer['computer_id']); ?>">
                <div class="form-group">
                    <label for="computer_name">Computer Name:</label>
                    <input type="text" name="computer_name" class="form-control" value="<?php echo htmlspecialchars($computer['computer_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control" required>
                        <option value="available" <?php if ($computer['status'] == 'available') echo 'selected'; ?>>Available</option>
                        <option value="in use" <?php if ($computer['status'] == 'in use') echo 'selected'; ?>>In Use</option>
                        <option value="under maintenance" <?php if ($computer['status'] == 'under maintenance') echo 'selected'; ?>>Under Maintenance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($computer['location']); ?>" required>
                </div>
                <button type="submit" name="update_computer" class="btn btn-primary">Update Computer</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
