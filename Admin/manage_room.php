<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

$query = "SELECT * FROM meeting_rooms";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Rooms</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Manage Meeting Rooms</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
        <tr>
            <th>Room Number</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['room_number']; ?></td>
                <td><?php echo $row['capacity']; ?></td>
                <td>
                    <button class="btn">
                        <a href="edit_room.php?room_id=<?php echo $row['room_id']; ?>">Edit</a>
                    </button>
                    <button class="btn">
                        <a href="update_maintenance_schedule.php?room_id=<?php echo $row['room_id']; ?>">Maintenance schedule</a>
                    </button>
                    <button class="btn">
                        <a href="delete_room.php?room_id=<?php echo $row['room_id']; ?>">Delete</a>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
        <div class="col-md-2"></div>
    </div>
</body>
</html>
