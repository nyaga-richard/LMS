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

if(isset($_POST['delete_card'])) {
    $query = "DELETE FROM cards WHERE card_id = '$card_id'";
    if(mysqli_query($connection, $query)) {
        echo "<script>alert('Card deleted successfully'); window.location.href = 'manage_cards.php';</script>";
    } else {
        echo "<script>alert('Error deleting card');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Card</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Are you sure you want to delete Card with ID <?php echo $card['card_id']; ?>?</h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <button type="submit" name="delete_card" class="btn btn-danger">Yes, Delete Card</button>
                <a href="manage_cards.php" class="btn btn-primary">Cancel</a>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>
