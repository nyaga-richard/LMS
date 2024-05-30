<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['add_card'])) {
    $student_id = $_POST['student_id'];
    $resource_type = $_POST['resource_type'];
    $activation_date = $_POST['activation_date'];
    $status = $_POST['status'];

    $query = "INSERT INTO cards (student_id, resource_type, activation_date, status) 
              VALUES ('$student_id', '$resource_type', '$activation_date', '$status')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Card added successfully'); window.location.href = 'manage_cards.php';</script>";
    } else {
        echo "<script>alert('Error adding card');</script>";
    }
}

$students_query = "SELECT * FROM students";
$students_result = mysqli_query($connection, $students_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Library Card</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Add Library Card</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="student_id">Student:</label>
                <select name="student_id" class="form-control" required>
                    <?php while ($student = mysqli_fetch_assoc($students_result)) { ?>
                        <option value="<?php echo $student['student_id']; ?>"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="resource_type">Resource Type:</label>
                <select name="resource_type" class="form-control" required>
                    <option value="Book">Book</option>
                    <option value="Computer">Computer</option>
                    <option value="Meeting Room">Meeting Room</option>
                    <option value="Magazine">Magazine</option>
                </select>
            </div>
            <div class="form-group">
                <label for="activation_date">Activation Date:</label>
                <input type="date" name="activation_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" name="add_card" class="btn btn-primary">Add Card</button>
        </form>
    </div>
</body>
</html>
