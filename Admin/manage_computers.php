<?php
    require("functions.php");
    session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

$query = "SELECT * FROM computers";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Computers</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Manage Computers</h4><br></center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Computer ID</th>
                        <th>Computer Name</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['computer_id']; ?></td>
                            <td><?php echo $row['computer_name']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                            <button class="btn">
                                <a href="edit_computer.php?computer_id=<?php echo $row['computer_id']; ?>">Edit</a>
                            </button>
                            <button class="btn">
                                <a href="delete_computer.php?computer_id=<?php echo $row['computer_id']; ?>">Delete</a>
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
