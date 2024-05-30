<?php
    require("functions.php");
    session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['add_computer'])) {
    $computer_name = $_POST['computer_name'];
    $status = $_POST['status'];
    $location = $_POST['location'];

    $query = "INSERT INTO computers (computer_name, status, location) VALUES ('$computer_name', '$status', '$location')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Computer added successfully'); window.location.href = 'manage_computers.php';</script>";
    } else {
        echo "<script>alert('Error adding computer');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Computer</title>
    <?php include 'head.php'; ?>
    <script type="text/javascript">
          function alertMsg(){
              alert(Computer added successfully...);
              window.location.href = "admin_dashboard.php";
          }
      </script>
    </head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Add a new Computer</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="computer_name">Computer Name:</label>
                        <input type="text" name="computer_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="available">Available</option>
                            <option value="in use">In Use</option>
                            <option value="under maintenance">Under Maintenance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" name="location"class="form-control" required>
                    </div>
                        <button type="submit" name="add_computer" class="btn btn-primary">Add Computer</button>
                </form>
            </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
