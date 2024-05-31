<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM cards";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Cards</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Manage Cards</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Card ID</th>
                    <th>Student ID</th>
                    <th>Resource Type</th>
                    <th>Activation Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['card_id']; ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['resource_type']; ?></td>
                        <td><?php echo $row['activation_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <button class="btn">
                                <a href="edit_card.php?card_id=<?php echo $row['card_id']; ?>">Edit</a>
                            </button>
                            <button class="btn">
                                <a href="delete_card.php?card_id=<?php echo $row['card_id']; ?>">Delete</a>
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

<?php
mysqli_close($connection);
?>
