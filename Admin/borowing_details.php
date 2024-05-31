<?php
require("functions.php");
session_start();

$search_query_book = isset($_GET['book_name']) ? $_GET['book_name'] : '';
$search_query_student = isset($_GET['student_name']) ? $_GET['student_name'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Borrowings</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Display Borrowings</h4><br></center>
    <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-9">
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search by Book Name" aria-label="Search" id="book_name" name="book_name" value="<?php echo isset($search_query_book) ? htmlspecialchars($search_query_book) : ''; ?>">                    
                    </form>
                    <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search by Student Name" aria-label="Search" id="student_name" name="student_name" value="<?php echo isset($search_query_student) ? htmlspecialchars($search_query_student) : ''; ?>">
                    </form>
                    <form class="form-inline">
                    <label for="start_date">Start Date:</label>
                    <input class="form-control mr-sm-2" type="date" placeholder="Start date" aria-label="Search" id="start_date" name="start_date" value="<?php echo isset($start_date) ? htmlspecialchars($start_date) : ''; ?>">
                    </form>
                    <form class="form-inline">
                    <label for="start_date">End Date:</label>
                    <input class="form-control mr-sm-2" type="date" placeholder="End date" aria-label="Search" id="end_date" name="end_date" value="<?php echo isset($end_date) ? htmlspecialchars($end_date) : ''; ?>">
                    </form>
                    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Filter">
                </nav>
    <br>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "lms");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT 
    s.first_name, 
    s.last_name, 
    br.borrow_date AS issue_date, 
    bk.book_name 
FROM 
    students s 
JOIN 
    cards c ON s.student_id = c.student_id
JOIN 
    borrowed_resources br ON c.card_id = br.card_id 
JOIN 
    book_copies bc ON br.resource_id = bc.copy_id
JOIN 
    books bk ON bc.book_id = bk.book_id
WHERE 
    br.return_date IS NULL";
    
    if (!empty($search_query_book)) {
        $sql .= " AND bk.book_name LIKE '%$search_query_book%'";
    }
    
    if (!empty($search_query_student)) {
        $sql .= " AND (s.first_name LIKE '%$search_query_student%' OR s.last_name LIKE '%$search_query_student%')";
    }
    
    if (!empty($start_date)) {
        $sql .= " AND b.issue_date >= '$start_date'";
    }
    
    if (!empty($end_date)) {
        $sql .= " AND b.issue_date <= '$end_date'";
    }
    
    $result = mysqli_query($connection, $sql);
    ?>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Book Name</th>
                <th>Issue Date</th>
            </tr>
        </thead>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No borrowings found.</p>
    <?php } ?>

</body>
</html>
<?php mysqli_close($connection); ?>
