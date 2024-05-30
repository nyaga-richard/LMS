<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['magazine_id']) && isset($_GET['action'])) {
    $magazine_id = $_GET['magazine_id'];
    $action = $_GET['action'];

    if ($action == 'delete_all') {
        // Delete all copies of the magazine and the magazine itself
        $query = "DELETE FROM magazine_copies WHERE magazine_id = '$magazine_id'";
        $query_run = mysqli_query($connection, $query);
        
        if ($query_run) {
            $query = "DELETE FROM magazines WHERE magazine_id = '$magazine_id'";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                echo "<script type='text/javascript'>
                        alert('All copies and the magazine deleted successfully...');
                        window.location.href = 'manage_magazine.php';
                      </script>";
            } else {
                echo "<script type='text/javascript'>
                        alert('Error deleting the magazine: " . mysqli_error($connection) . "');
                        window.location.href = 'manage_magazine.php';
                      </script>";
            }
        } else {
            echo "<script type='text/javascript'>
                    alert('Error deleting copies: " . mysqli_error($connection) . "');
                    window.location.href = 'manage_magazine.php';
                  </script>";
        }
    } elseif ($action == 'delete_copy') {
        // Display a form to delete a specific copy
        if (isset($_POST['delete_copy'])) {
            $copy_id = $_POST['copy_id'];

            $query = "DELETE FROM magazine_copies WHERE copy_id = '$copy_id'";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                echo "<script type='text/javascript'>
                        alert('Copy deleted successfully...');
                        window.location.href = 'manage_magazine.php';
                      </script>";
            } else {
                echo "<script type='text/javascript'>
                        alert('Error deleting the copy: " . mysqli_error($connection) . "');
                        window.location.href = 'manage_magazine.php';
                      </script>";
            }
        } else {
            $query = "SELECT * FROM magazine_copies WHERE magazine_id = '$magazine_id'";
            $query_run = mysqli_query($connection, $query);
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Delete Copy</title>
                <?php include 'head.php'; ?>
            </head>
            <body>
                <?php include 'navtop.php'; ?>
                <?php include 'navbar.php'; ?>
                <center><h4>Select a Copy to Delete</h4><br></center>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="copy_id">Copy ID:</label>
                                <select class="form-control" name="copy_id" required>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        echo "<option value='" . $row['copy_id'] . "'>Copy ID: " . $row['copy_id'] . ", Purchase Date: " . $row['purchase_date'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="delete_copy" class="btn btn-danger">Delete Copy</button>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </body>
            </html>
            <?php
        }
    }
} else {
    echo "<script type='text/javascript'>
            alert('Invalid request.');
            window.location.href = 'manage_magazine.php';
          </script>";
}
?>
