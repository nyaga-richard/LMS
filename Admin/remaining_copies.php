<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remaining Copies of a Book</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    <center><h4>Remaining Copies of a Book</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
    <form method="get" action="">
    <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                        <label for="book_id">Select Book:</label>
                        <select class="form-control mr-sm-8" name="book_id" id="book_id">
                            <?php
                            // Database connection
                            $connection = mysqli_connect("localhost", "root", "", "lms");
                            if (!$connection) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Fetch books
                            $booksSql = "SELECT book_id, book_name FROM books";
                            $booksResult = mysqli_query($connection, $booksSql);

                            if (mysqli_num_rows($booksResult) > 0) {
                                while ($bookRow = mysqli_fetch_assoc($booksResult)) {
                                    echo "<option value='{$bookRow['book_id']}'>{$bookRow['book_name']}</option>";
                                }
                            }

                            // Close connection
                            mysqli_close($connection);
                            ?>
                        </select>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Check Remaining Copies</button>
                        </form>
                        </nav>   
                    </form>

                    <?php
                    if (isset($_GET['book_id'])) {
                        $bookId = $_GET['book_id'];

                        // Database connection
                        $connection = mysqli_connect("localhost", "root", "", "lms");
                        if (!$connection) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Fetch total and borrowed copies
                        $totalCopiesSql = "SELECT COUNT(*) as total FROM book_copies WHERE book_id = $bookId";
                        $totalCopiesResult = mysqli_query($connection, $totalCopiesSql);
                        $totalCopiesRow = mysqli_fetch_assoc($totalCopiesResult);
                        $totalCopies = $totalCopiesRow['total'];

                        $borrowedCopiesSql = "SELECT COUNT(*) as borrowed FROM borrowed_resources br
                                            JOIN book_copies bc ON br.resource_id = bc.copy_id
                                            WHERE bc.book_id = $bookId AND br.return_date IS NULL";
                        $borrowedCopiesResult = mysqli_query($connection, $borrowedCopiesSql);
                        $borrowedCopiesRow = mysqli_fetch_assoc($borrowedCopiesResult);
                        $borrowedCopies = $borrowedCopiesRow['borrowed'];

                        $remainingCopies = $totalCopies - $borrowedCopies;

                        echo "<h3>Remaining Copies of Selected Book</h3>";
                        echo "<p>Total Copies: $totalCopies</p>";
                        echo "<p>Borrowed Copies: $borrowedCopies</p>";
                        echo "<p>Remaining Copies: $remainingCopies</p>";

                        // Close connection
                        mysqli_close($connection);
                    }
                    ?>
</body>
</html>

