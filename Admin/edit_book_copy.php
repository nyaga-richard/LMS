<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['copy_id'])) {
    $copy_id = $_GET['copy_id'];

    // Fetch book copy data
    $copy_query = "SELECT * FROM book_copies WHERE copy_id='$copy_id'";
    $copy_result = mysqli_query($connection, $copy_query);
    $copy = mysqli_fetch_assoc($copy_result);

    // Fetch books data for dropdown
    $books_query = "SELECT * FROM books";
    $books_result = mysqli_query($connection, $books_query);
} else {
    echo "<script>alert('No copy ID provided'); window.location.href = 'add_copies.php?bn=" . urlencode($_GET['bn']) . "&bname=" . urlencode($_GET['bname']) . "';</script>";
}

// Handle form submission for editing a book copy
if (isset($_POST['edit_book_copy'])) {
    $book_id = $_POST['book_id'];
    $barcode = $_POST['barcode'];
    $price = $_POST['price'];
    $date_of_purchase = $_POST['date_of_purchase'];
    $rack_number = $_POST['rack_number'];

    $query = "UPDATE book_copies SET book_id='$book_id', barcode='$barcode', price='$price', date_of_purchase='$date_of_purchase', rack_number='$rack_number'
              WHERE copy_id='$copy_id'";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Book copy updated successfully'); window.location.href = 'add_copies.php?bn=" . $_GET['bn'] . "&bname=" . urlencode($_GET['bname']) . "';</script>";
    } else {
        echo "<script>alert('Error updating book copy');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book Copy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2 class="mt-5">Edit Book Copy</h2>
        <form action="edit_book_copy.php?copy_id=<?php echo $copy_id; ?>" method="post">
            <div class="form-group">
                <label for="book_id">Book:</label>
                <select name="book_id" class="form-control" required>
                    <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                        <option value="<?php echo $book['book_id']; ?>" <?php echo $book['book_id'] == $copy['book_id'] ? 'selected' : ''; ?>><?php echo $book['book_name']; ?></option>
                    <?php } ?>
                </select>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode:</label>
                        <input type="text" name="barcode" class="form-control" value="<?php echo $copy['barcode']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $copy['price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_purchase">Date of Purchase:</label>
                        <input type="date" name="date_of_purchase" class="form-control" value="<?php echo $copy['date_of_purchase']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="rack_number">Rack Number:</label>
                        <input type="number" name="rack_number" class="form-control" value="<?php echo $copy['rack_number']; ?>" required>
                    </div>
                    <button type="submit" name="edit_book_copy" class="btn btn-primary">Update Book Copy</button>
                </form>
            </div>
        </body>
        </html>
        
        <?php
        mysqli_close($connection);
        ?>    