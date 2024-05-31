<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Computers</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Browse Computers</h4><br></center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Computer ID</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "lms");
                        if (!$connection) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql = "SELECT c.computer_id, 
                                    IF(br.resource_id IS NULL, 'Available', 'In Use') AS status
                                FROM computers c
                                LEFT JOIN borrowed_resources br 
                                ON c.computer_id = br.resource_id 
                                AND br.return_date IS NULL";
                        
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>" . htmlspecialchars($row['computer_id']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                                <td><a class='btn btn-primary' href='request_booking.php?computer_id=" . htmlspecialchars($row['computer_id']) . "'>Book now</a></td>
                              </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No computers available.</td></tr>";
                        }

                        mysqli_close($connection);
                        ?>
                    </tbody>
                </table>
</body>
</html>
