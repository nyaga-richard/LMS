<?php
    require("functions.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Books</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Overdue Books</h4><br></center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "lms");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $today = date("Y-m-d");

    // Retrieve overdue books
    $sql = "SELECT br.borrow_id, b.book_name, bc.barcode, br.return_date, s.first_name, s.last_name
            FROM borrowed_resources br
            JOIN book_copies bc ON br.resource_id = bc.copy_id
            JOIN books b ON bc.book_id = b.book_id
            JOIN cards c ON br.card_id = c.card_id
            JOIN students s ON c.student_id = s.student_id
            WHERE br.return_date < '$today' AND c.resource_type = 'Book'";
    
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Borrow ID</th>
                    <th>Book Name</th>
                    <th>Barcode</th>
                    <th>Return Date</th>
                    <th>Student Name</th>
                </tr>
                </thead>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['borrow_id']}</td>
                    <td>{$row['book_name']}</td>
                    <td>{$row['barcode']}</td>
                    <td>{$row['return_date']}</td>
                    <td>{$row['first_name']} {$row['last_name']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No overdue books.";
    }

    // Close connection
    mysqli_close($connection);
    ?>
</body>
</html>
