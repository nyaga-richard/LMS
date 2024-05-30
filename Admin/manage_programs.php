<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

$query = "SELECT * FROM computer_programs";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Programs</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Manage Programs</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Program ID</th>
                        <th>Program Name</th>
                        <th>Version</th>
                        <th>Installed On (Computer ID)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['program_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['program_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['version']); ?></td>
                            <td><?php echo htmlspecialchars($row['installed_on']); ?></td>
                            <td>
                                <a href="edit_program.php?program_id=<?php echo htmlspecialchars($row['program_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_program.php?program_id=<?php echo htmlspecialchars($row['program_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this program?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- <a href="add_program.php" class="btn btn-primary">Add New Program</a> -->
        </div>
        <div class="col-md-2"></div>
    </div>
</body>
</html>
