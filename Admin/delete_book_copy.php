<?php
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['copy_id'])) {
    $copy_id = $_GET['copy_id'];

    $query = "DELETE FROM book_copies WHERE copy_id='$copy_id'";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Book copy deleted successfully'); window.location.href = 'add_copies.php?bn=" . urlencode($_GET['bn']) . "&bname=" . urlencode($_GET['bname']) . "';</script>";
    } else {
        echo "<script>alert('Error deleting book copy');</script>";
    }
} else {
    echo "<script>alert('No copy ID provided'); window.location.href = 'manage_book_copies.php?bn=" . urlencode($_GET['bn']) . "&bname=" . urlencode($_GET['bname']) . "';</script>";
}
?>
