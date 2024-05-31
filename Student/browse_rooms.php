<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

$query = "SELECT * FROM meeting_rooms";
$rooms_result = mysqli_query($connection, $query);

$query = "SELECT * FROM maintenance_schedules";
$maintenance_result = mysqli_query($connection, $query);

$maintenance = [];
while ($row = mysqli_fetch_assoc($maintenance_result)) {
    $maintenance[$row['room_id']][] = $row;
}

$query = "SELECT * FROM bookings";
$bookings_result = mysqli_query($connection, $query);

$bookings = [];
while ($row = mysqli_fetch_assoc($bookings_result)) {
    $bookings[$row['room_id']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Rooms</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Browse Meeting Rooms</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
                <thead>
        <tr>
            <th>Room Number</th>
            <th>Capacity</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
        <?php while ($room = mysqli_fetch_assoc($rooms_result)) { 
            $is_available = true;

            if (isset($maintenance[$room['room_id']])) {
                $is_available = false;
            } else {
                if (isset($bookings[$room['room_id']])) {
                    $is_available = false;
                }
            }
        ?>
            <tr>
                <td><?php echo $room['room_number']; ?></td>
                <td><?php echo $room['capacity']; ?></td>
                <td><?php echo $is_available ? 'Available' : 'Not Available'; ?></td>
                <td>
                    <a href="request_booking.php?room_id=<?php echo $room['room_id']; ?>">Book</a>
                    <!-- <a href="add_maintenance.php?room_id=<?php echo $room['room_id']; ?>">Add Maintenance</a> -->
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
