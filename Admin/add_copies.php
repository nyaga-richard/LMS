<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['bn'])) {
    $book_id = $_GET['bn'];
    $book_name = urldecode($_GET['bname']);
    $book_nam = $_GET['bname'];
}

if (isset($_POST['add_copies'])) {
    $num_copies = $_POST['num_copies'];
    $purchase_date = $_POST['purchase_date'];
    
    for ($i = 0; $i < $num_copies; $i++) {
        $query = "INSERT INTO book_copies (book_id, purchase_date) VALUES ('$book_id', '$purchase_date')";
        $query_run = mysqli_query($connection, $query);
    }

    if ($query_run) {
        echo "<script type='text/javascript'>
                alert('Copies added successfully');
                window.location.href = 'admin_dashboard.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error adding copies: " . mysqli_error($connection) . "');
              </script>";
    }
}

    // Fetch book copies data
$book_copies_query = "SELECT book_copies.*, books.book_name FROM book_copies JOIN books ON book_copies.book_id = books.book_id";
$book_copies_result = mysqli_query($connection, $book_copies_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Book Copies</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Manage Copies for Book: <?php echo $book_name; ?> (Book ID: <?php echo $book_id; ?>)</h4><br></center>
    <div class="container">
        <h2 class="mt-5">Manage Book Copies</h2>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Barcode</th>
                    <th>Price</th>
                    <th>Date of Purchase</th>
                    <th>Rack Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($copy = mysqli_fetch_assoc($book_copies_result)) { ?>
                    <tr>
                        <td><?php echo $copy['book_name']; ?></td>
                        <td><?php echo $copy['barcode']; ?></td>
                        <td><?php echo $copy['price']; ?></td>
                        <td><?php echo $copy['date_of_purchase']; ?></td>
                        <td><?php echo $copy['rack_number']; ?></td>
                        <td>
                            <a href="edit_book_copy.php?copy_id=<?php echo $copy['copy_id']; ?>&bn=<?php echo $book_id;?>&bname=<?php echo $book_name;?>" class="btn btn-warning">Edit</a>
                            <a href="delete_book_copy.php?copy_id=<?php echo $copy['copy_id']; ?>&bn=<?php echo $book_id;?>&bname=<?php echo $book_name;?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this copy?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="col-md-4">
    <a href="add_book_copy.php?bn=<?php echo $book_id;?>&bname=<?php echo $book_name;?>" class="btn btn-primary mb-3">Add Book Copy</a>
    </div>
    </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
