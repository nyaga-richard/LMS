<?php
    require("functions.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room Booking Schedule</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Meeting Room Booking Schedule</h4><br></center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "lms");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve meeting rooms
    $sql = "SELECT * FROM meeting_rooms";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Loop through each meeting room
        while ($row = mysqli_fetch_assoc($result)) {
            $roomId = $row['room_id'];
            $roomNumber = $row['room_number'];

            echo "<h3>Meeting Room: $roomNumber</h3>";

            // Retrieve booking schedule for the current meeting room
            $bookingSql = "SELECT * FROM bookings WHERE room_id = $roomId";
            $bookingResult = mysqli_query($connection, $bookingSql);

            if (mysqli_num_rows($bookingResult) > 0) {
                // Display booking schedule in a table
                echo "<table class='table table-bordered table-hover'>
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>";
                while ($bookingRow = mysqli_fetch_assoc($bookingResult)) {
                    echo "<tr>
                            <td>" . $bookingRow['booking_id'] . "</td>
                            <td>" . $bookingRow['start_time'] . "</td>
                            <td>" . $bookingRow['end_time'] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No bookings for this meeting room.";
            }
            echo "<br>";
        }
    } else {
        echo "No meeting rooms found.";
    }

    // Close connection
    mysqli_close($connection);
    ?>
</body>
</html>
