<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Magazines</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
<body>
    <center><h2>Browse Magazines</h2></center>
    <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-bordered table-hover">
        <tr>
            <th>Magazine Name</th>
            <th>Edition Number</th>
            <th>Publication Date</th>
            <th>Publisher</th>
            <th>Editor</th>
            <th>Action</th>
        </tr>
        <?php
        $connection = mysqli_connect("localhost", "root", "", "lms");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM magazines";
        
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['edition_number']}</td>
                        <td>{$row['publication_date']}</td>
                        <td>{$row['publisher']}</td>
                        <td>{$row['editor']}</td>
                        <td><a class='btn btn-primary' href='request_booking.php?magazine_id=" . htmlspecialchars($row['magazine_id']) . "'>Book now</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No magazines available.</td></tr>";
        }

        mysqli_close($connection);
        ?>
    </table>
    </div>
            <div class="col-md-1"></div>
        </div>
</body>
</html>
