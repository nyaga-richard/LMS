<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['update_magazine'])) {
    $magazine_id = $_POST['magazine_id'];
    $title = $_POST['title'];
    $edition = $_POST['edition'];
    $publication_date = $_POST['publication_date'];
    $publisher = $_POST['publisher'];
    $editor = $_POST['editor'];

    $query = "UPDATE magazines SET 
                title='$title', 
                edition_number='$edition', 
                publication_date='$publication_date', 
                publisher='$publisher', 
                editor='$editor' 
              WHERE magazine_id='$magazine_id'";
    
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Magazine updated successfully'); window.location.href = 'manage_magazine.php';</script>";
    } else {
        echo "<script>alert('Error updating magazine');</script>";
    }
}

$magazine_id = isset($_GET['magazine_id']) ? $_GET['magazine_id'] : null;

if (!$magazine_id) {
    echo "<script>alert('No magazine ID provided'); window.location.href = 'manage_magazine.php';</script>";
    exit;
}

$query = "SELECT * FROM magazines WHERE magazine_id='$magazine_id'";
$result = mysqli_query($connection, $query);
$magazine = mysqli_fetch_assoc($result);

if (!$magazine) {
    echo "<script>alert('Magazine not found'); window.location.href = 'manage_magazine.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Magazine</title>
    <?php include 'head.php'; ?>
    
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Edit Magazine</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="magazine_id" value="<?php echo htmlspecialchars($magazine['magazine_id']); ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($magazine['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="edition">Edition:</label>
                    <input type="text" name="edition" class="form-control" value="<?php echo htmlspecialchars($magazine['edition_number']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="publication_date">Publication Date:</label>
                    <input type="date" id="publication_date" name="publication_date" class="form-control" value="<?php echo htmlspecialchars($magazine['publication_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <input type="text" name="publisher" class="form-control" value="<?php echo htmlspecialchars($magazine['publisher']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="editor">Editor:</label>
                    <input type="text" name="editor" class="form-control" value="<?php echo htmlspecialchars($magazine['editor']); ?>" required>
                </div>
                <button type="submit" name="update_magazine" class="btn btn-primary">Update Magazine</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
