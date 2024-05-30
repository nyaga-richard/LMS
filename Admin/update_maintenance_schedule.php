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

if(isset($_POST['update_schedule'])) {
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check if maintenance schedule overlaps with existing bookings
    $overlap_query = "SELECT * FROM bookings 
                      WHERE room_id = '$room_id' 
                      AND (('$start_time' BETWEEN start_time AND end_time)
                      OR ('$end_time' BETWEEN start_time AND end_time))";
    $overlap_result = mysqli_query($connection, $overlap_query);
    if(mysqli_num_rows($overlap_result) > 0) {
        echo "<script>alert('Maintenance schedule overlaps with existing bookings');</script>";
    } else {
        $insert_query = "INSERT INTO maintenance_schedules (room_id, start_time, end_time) 
                         VALUES ('$room_id', '$start_time', '$end_time')
                         ON DUPLICATE KEY UPDATE start_time = '$start_time', end_time = '$end_time'";
        if(mysqli_query($connection, $insert_query)) {
            echo "<script>alert('Maintenance schedule updated successfully'); window.location.href = 'manage_room.php';</script>";
        } else {
            echo "<script>alert('Error updating maintenance schedule');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Maintenance Schedule</title>
    <?php include 'head.php'; ?>
    
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Update Maintenance Schedule for Room <?php echo $room['room_number']; ?></h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                <div class="form-group">
                    <label for="start_time">Start Time:</label>
                    <input type="datetime-local" name="start_time" class="form-control" required><br>
                </div>
                <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="datetime-local" name="end_time" class="form-control" required><br>
                </div>
                <button type="submit" name="update_schedule" class="btn btn-primary">Update Schedule</button>
            </form>
</body>
</html>
