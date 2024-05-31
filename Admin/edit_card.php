<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if(isset($_GET['card_id'])) {
    $card_id = $_GET['card_id'];

    $query = "SELECT * FROM cards WHERE card_id = '$card_id'";
    $result = mysqli_query($connection, $query);
    $card = mysqli_fetch_assoc($result);

    if(!$card) {
        echo "<script>alert('Card not found'); window.location.href = 'manage_cards.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Card ID not provided'); window.location.href = 'manage_cards.php';</script>";
    exit;
}

if(isset($_POST['edit_card'])) {
    $student_id = $_POST['student_id'];
    $resource_type = $_POST['resource_type'];
    $activation_date = $_POST['activation_date'];
    $status = $_POST['status'];

    $query = "UPDATE cards SET student_id = '$student_id', resource_type = '$resource_type', activation_date = '$activation_date', status = '$status' WHERE card_id = '$card_id'";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Card updated successfully'); window.location.href = 'manage_cards.php';</script>";
    } else {
        echo "<script>alert('Error updating card');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Card</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Edit Card</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="card_id" value="<?php echo $card_id; ?>">
                <div class="form-group">
                    <label for="student_id">Student ID:</label>
                    <input type="number" name="student_id" class="form-control" value="<?php echo $card['student_id']; ?>" required><br>
                </div>
                <div class="form-group">
                    <label for="resource_type">Resource Type:</label>
                    <select name="resource_type" class="form-control" required>
                        <option value="Book" <?php if($card['resource_type'] == 'Book') echo 'selected'; ?>>Book</option>
                        <option value="Computer" <?php if($card['resource_type'] == 'Computer') echo 'selected'; ?>>Computer</option>
                        <option value="Meeting Room" <?php if($card['resource_type'] == 'Meeting Room') echo 'selected'; ?>>Meeting Room</option>
                        <option value="Magazine" <?php if($card['resource_type'] == 'Magazine') echo 'selected'; ?>>Magazine</option>
                        <option value="Computer Program" <?php if($card['resource_type'] == 'Computer Program') echo 'selected'; ?>>Computer Program</option>
                    </select><br>
                </div>
                <div class="form-group">
                    <label for="activation_date">Activation Date:</label>
                    <input type="date" name="activation_date" class="form-control" value="<?php echo $card['activation_date']; ?>" required><br>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control" required>
                        <option value="Active" <?php if($card['status'] == 'Active') echo 'selected'; ?>>Active</option>
                        <option value="Inactive" <?php if($card['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                    </select><br>
                </div>
                <button type="submit" name="edit_card" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
