<?php
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['computer_id'])) {
    $computer_id = $_GET['computer_id'];

    $query = "DELETE FROM computers WHERE computer_id = '$computer_id'";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Computer deleted successfully'); window.location.href = 'manage_computers.php';</script>";
    } else {
        echo "<script>alert('Error deleting computer');</script>";
    }
}
?>
