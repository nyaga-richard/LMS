<?php
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['program_id'])) {
    $program_id = $_GET['program_id'];

    $query = "DELETE FROM computer_programs WHERE program_id = '$program_id'";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Program deleted successfully'); window.location.href = 'manage_programs.php';</script>";
    } else {
        echo "<script>alert('Error deleting program');</script>";
    }
}
?>
