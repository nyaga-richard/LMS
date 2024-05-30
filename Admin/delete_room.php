<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if(isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    $query = "SELECT * FROM meeting_rooms WHERE room_id = '$room_id'";
    $result = mysqli_query($connection, $query);
    $room = mysqli_fetch_assoc($result);

    if(!$room) {
        echo "<script>alert('Room not found'); window.location.href = 'manage_room.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Room ID not provided'); window.location.href = 'manage_room.php';</script>";
    exit;
}

if(isset($_POST['delete_room'])) {
    $query = "DELETE FROM meeting_rooms WHERE room_id = '$room_id'";
    if(mysqli_query($connection, $query)) {
        echo "<script>alert('Room deleted successfully'); window.location.href = 'manage_room.php';</script>";
    } else {
        echo "<script>alert('Error deleting room');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Room</title>
    <?php include 'head.php'; ?>
    
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center>Are you sure you want to delete Room <?php echo $room['room_number']; ?>?</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
    <form action="" method="post">
    <button class="btn">
        <button type="submit" name="delete_room" class="btn btn-danger">Yes, Delete Room</button>
    </button>
    <button class="btn">
        <a href="manage_room.php" class="btn btn-primary">Cancel</a>
    </button>
    </form>
</body>
</html>
