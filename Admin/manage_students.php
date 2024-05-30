<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission for adding a new student
if (isset($_POST['add_student'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $postal_address = $_POST['postal_address'];
    $email_address = $_POST['email_address'];
    $telephone_number = $_POST['telephone_number'];
    $university_registered = isset($_POST['university_registered']) ? 1 : 0;

    $query = "INSERT INTO students (first_name, last_name, postal_address, email_address, phone_number, university_registered)
              VALUES ('$first_name', '$last_name', '$postal_address', '$email_address', '$telephone_number', '$university_registered')";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Student added successfully'); window.location.href = 'manage_students.php';</script>";
    } else {
        echo "<script>alert('Error adding student');</script>";
    }
}

// Handle form submission for editing a student
if (isset($_POST['edit_student'])) {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $postal_address = $_POST['postal_address'];
    $email_address = $_POST['email_address'];
    $telephone_number = $_POST['telephone_number'];
    $university_registered = isset($_POST['university_registered']) ? 1 : 0;

    $query = "UPDATE students SET 
                first_name='$first_name', 
                last_name='$last_name', 
                postal_address='$postal_address', 
                email_address='$email_address', 
                phone_number='$telephone_number', 
                university_registered='$university_registered'
              WHERE student_id='$student_id'";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Student updated successfully'); window.location.href = 'manage_students.php';</script>";
    } else {
        echo "<script>alert('Error updating student');</script>";
    }
}

// Handle deletion of a student
if (isset($_GET['delete_student_id'])) {
    $student_id = $_GET['delete_student_id'];

    $query = "DELETE FROM students WHERE student_id='$student_id'";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Student deleted successfully'); window.location.href = 'manage_students.php';</script>";
    } else {
        echo "<script>alert('Error deleting student');</script>";
    }
}

// Fetch students data
$students_query = "SELECT * FROM students";
$students_result = mysqli_query($connection, $students_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Manage Students</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Postal Address</th>
                    <th>Email Address</th>
                    <th>Telephone Number</th>
                    <th>University Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = mysqli_fetch_assoc($students_result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['postal_address']); ?></td>
                        <td><?php echo htmlspecialchars($student['email_address']); ?></td>
                        <td><?php echo htmlspecialchars($student['phone_number']); ?></td>
                        <td><?php echo $student['university_registered'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="edit_student.php?student_id=<?php echo htmlspecialchars($student['student_id']); ?>" class="btn btn-warning">Edit</a>
                            <a href="manage_students.php?delete_student_id=<?php echo htmlspecialchars($student['student_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
