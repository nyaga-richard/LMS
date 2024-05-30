<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['add_room'])) {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];
    
    $query = "INSERT INTO meeting_rooms (room_number, capacity) VALUES ('$room_number', '$capacity')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Room added successfully'); window.location.href = 'manage_room.php';</script>";
    } else {
        echo "<script>alert('Error adding room');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Add a New Meeting Room</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="room_number">Room Number:</label>
                    <input type="text" name="room_number" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="capacity">Capacity:</label>
                    <input type="number" name="capacity" class="form-control" required><br>
                </div>
                <button type="submit" name="add_room" class="btn btn-primary">Add Room</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
