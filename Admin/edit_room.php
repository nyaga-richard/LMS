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
        echo "<script>alert('Room not found'); window.location.href = 'manage_rooms.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Room ID not provided'); window.location.href = 'manage_rooms.php';</script>";
    exit;
}

if(isset($_POST['edit_room'])) {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];
    
    $query = "UPDATE meeting_rooms SET room_number = '$room_number', capacity = '$capacity' WHERE room_id = '$room_id'";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Room updated successfully'); window.location.href = 'manage_room.php';</script>";
    } else {
        echo "<script>alert('Error updating room');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <?php include 'head.php'; ?>
    
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Edit Meeting Room</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                <div class="form-group">
                    <label for="room_number">Room Number:</label>
                    <input type="text" name="room_number" class="form-control" value="<?php echo $room['room_number']; ?>" required><br>
                </div>
                <div class="form-group">
                    <label for="capacity">Capacity:</label>
                    <input type="number" name="capacity" class="form-control" value="<?php echo $room['capacity']; ?>" required><br>
                </div>
                <button type="submit" name="edit_room" class="btn btn-primary">Save Changes</button>
            </form>
</body>
</html>
