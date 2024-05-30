<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['magazine_id'])) {
    $magazine_id = $_GET['magazine_id'];
    $title = urldecode($_GET['title']);  

    if (isset($_POST['add_copies'])) {
        $num_copies = $_POST['num_copies'];
        $purchase_date = $_POST['purchase_date'];
        
        for ($i = 0; $i < $num_copies; $i++) {
            $query = "INSERT INTO magazine_copies (magazine_id, purchase_date) VALUES ('$magazine_id', '$purchase_date')";
            $query_run = mysqli_query($connection, $query);

            if (!$query_run) {
                echo "<script type='text/javascript'>
                        alert('Error adding copies: " . mysqli_error($connection) . "');
                      </script>";
                break;
            }
        }

        echo "<script type='text/javascript'>
                alert('Copies added successfully...');
                window.location.href = 'manage_magazine.php';
              </script>";
    }
} else {
    echo "<script type='text/javascript'>
            alert('Invalid request.');
            window.location.href = 'manage_magazine.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Magazine Copies</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" type="text/css" href="path_to_datepicker.css">
    <script src="path_to_datepicker.js"></script>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Add Copies for Magazine: <?php echo $title; ?></h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="num_copies">Number of Copies:</label>
                    <input type="number" name="num_copies" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="purchase_date">Purchase Date:</label>
                    <input type="date" id="purchase_date" name="purchase_date" class="form-control" required>
                </div>
                <button type="submit" name="add_copies" class="btn btn-primary">Add Copies</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var datepicker = new Datepicker(document.getElementById('purchase_date'));
        });
    </script>
</body>
</html>
