<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch student data
    $student_query = "SELECT * FROM students WHERE student_id='$student_id'";
    $student_result = mysqli_query($connection, $student_query);
    $student = mysqli_fetch_assoc($student_result);
    
    if (!$student) {
        echo "<script>alert('Student not found'); window.location.href = 'manage_students.php';</script>";
    }
} else {
    echo "<script>alert('No student ID provided'); window.location.href = 'manage_students.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Edit Student</h2>
        <form action="manage_students.php" method="post">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="postal_address">Postal Address:</label>
                <input type="text" name="postal_address" class="form-control" value="<?php echo htmlspecialchars($student['postal_address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email_address">Email Address:</label>
                <input type="email" name="email_address" class="form-control" value="<?php echo htmlspecialchars($student['email_address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telephone_number">Telephone Number:</label>
                <input type="text" name="telephone_number" class="form-control" value="<?php echo htmlspecialchars($student['phone_number']); ?>" required>
            </div>
            <div class="form-check">
                <input type="checkbox" name="university_registered" class="form-check-input" <?php echo $student['university_registered'] ? 'checked' : ''; ?>>
                <label for="university_registered" class="form-check-label">University Registered</label>
            </div>
            <button type="submit" name="edit_student" class="btn btn-primary mt-3">Update Student</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
