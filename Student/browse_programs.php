<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Computer Programs</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Browse Computer Programs</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Program Name</th>
                        <th>Version</th>
                        <th>Installed On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "lms");
                    if (!$connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT p.program_id, p.program_name, p.version, c.computer_name 
                            FROM computer_programs p
                            LEFT JOIN computers c ON p.installed_on = c.computer_id";
                    
                    $result = mysqli_query($connection, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>" . htmlspecialchars($row['program_name']) . "</td>
                            <td>" . htmlspecialchars($row['version']) . "</td>
                            <td>" . htmlspecialchars($row['computer_name']) . "</td>
                            <td><a class='btn btn-primary' href='request_booking.php?program_id=" . htmlspecialchars($row['program_id']) . "'>Book now</a></td>
                          </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No computer programs available.</td></tr>";
                    }

                    mysqli_close($connection);
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</body>
</html>
