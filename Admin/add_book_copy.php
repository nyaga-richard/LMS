<?php
require("functions.php");
session_start();

if (isset($_GET['bn'])) {
    $book_id = $_GET['bn'];
    $book_name = urldecode($_GET['bname']);
}

$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch books data for dropdown
$books_query = "SELECT * FROM books";
$books_result = mysqli_query($connection, $books_query);

// Handle form submission for adding a new book copy
if (isset($_POST['add_book_copy'])) {
    $book_id = $_POST['book_id'];
    $barcode = $_POST['barcode'];
    $price = $_POST['price'];
    $date_of_purchase = $_POST['date_of_purchase'];
    $rack_number = $_POST['rack_number'];

    $query = "INSERT INTO book_copies (book_id, barcode, price, date_of_purchase, rack_number)
              VALUES ('$book_id', '$barcode', '$price', '$date_of_purchase', '$rack_number')";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Book copy added successfully'); window.location.href = 'add_copies.php?bn=" . urlencode($_GET['bn']) . "&bname=" . urlencode($_GET['bname']) . "';</script>";
    } else {
        echo "<script>alert('Error adding book copy');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book Copy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Add Copies for Book: <?php echo $book_name; ?> (Book ID: <?php echo $book_id; ?>)</h4><br></center>
    <div class="container">
        <h2 class="mt-5">Add Book Copy</h2>
        <form action="add_book_copy.php" method="post">
            <div class="form-group">
                <label for="book_id">Book:</label>
                <select name="book_id" class="form-control" required>
                    <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                        <option value="<?php echo $book['book_id']; ?>"><?php echo $book['book_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="barcode">Barcode:</label>
                <input type="text" name="barcode" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_of_purchase">Date of Purchase:</label>
                <input type="date" name="date_of_purchase" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rack_number">Rack Number:</label>
                <input type="number" name="rack_number" class="form-control" required>
            </div>
            <button type="submit" name="add_book_copy" class="btn btn-primary">Add Book Copy</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
