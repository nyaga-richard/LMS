<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['add_magazine'])) {
    $title = $_POST['title'];
    $edition_number = $_POST['edition_number'];
    $publication_date = $_POST['publication_date'];
    $publisher = $_POST['publisher'];
    $editor = $_POST['editor'];
    
    $query = "INSERT INTO magazines (title, edition_number, publication_date, publisher, editor) 
              VALUES ('$title', '$edition_number', '$publication_date', '$publisher', '$editor')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "<script type='text/javascript'>
                alert('Magazine added successfully...');
                window.location.href = 'manage_magazine.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error adding magazine: " . mysqli_error($connection) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Magazine</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Add a New Magazine</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edition_number">Edition Number:</label>
                    <input type="text" name="edition_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="publication_date">Publication Date:</label>
                    <input type="date" id="publication_date" name="publication_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <input type="text" name="publisher" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editor">Editor:</label>
                    <input type="text" name="editor" class="form-control" required>
                </div>
                <button type="submit" name="add_magazine" class="btn btn-primary">Add Magazine</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
