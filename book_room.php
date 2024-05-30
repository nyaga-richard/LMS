<?php
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['book_room'])) {
    $room_id = $_POST['room_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check for maintenance schedule conflict
    $query = "SELECT * FROM maintenance_schedules WHERE room_id = '$room_id' AND 
              ((start_time <= '$start_time' AND end_time >= '$start_time') OR 
               (start_time <= '$end_time' AND end_time >= '$end_time') OR 
               (start_time >= '$start_time' AND end_time <= '$end_time'))";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('The room is under maintenance during the selected time');</script>";
    } else {
        // Check for booking conflict
        $query = "SELECT * FROM bookings WHERE room_id = '$room_id' AND 
                  ((start_time <= '$start_time' AND end_time >= '$start_time') OR 
                   (start_time <= '$end_time' AND end_time >= '$end_time') OR 
                   (start_time >= '$start_time' AND end_time <= '$end_time'))";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('The room is already booked during the selected time');</script>";
        } else {
            // Book the room
            $query = "INSERT INTO bookings (room_id, start_time, end_time) VALUES ('$room_id', '$start_time', '$end_time')";
            if (mysqli_query($connection, $query)) {
                echo "<script>alert('Room booked successfully'); window.location.href = 'view_rooms.php';</script>";
            } else {
                echo "<script>alert('Error booking room');</script>";
            }
        }
    }
}

$query = "SELECT * FROM meeting_rooms";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Room</title>
</head>
<body>
    <h2>Book Room</h2>
    <form action="" method="post">
        <label for="room_id">Room:</label>
        <select name="room_id" required>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['room_id']; ?>"><?php echo $row['room_number']; ?></option>
            <?php } ?>
        </select><br>
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" name="start_time" required><br>
        <label for="end_time">End Time:</label>
        <input type="datetime-local" name="end_time" required><br>
        <button type="submit" name="book_room">Book Room</button>
    </form>
</body>
</html>
