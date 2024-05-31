<?php
session_start();
if(isset($_GET['book_id']))
{
    $resource_id = $_GET['book_id'];
    $resource_type = "Book";
}
if(isset($_GET['magazine_id']))
{
    $resource_id = $_GET['magazine_id'];
    $resource_type = "Magazine";
}
if(isset($_GET['room_id']))
{
    $resource_id = $_GET['room_id'];
    $resource_type = "Meeting Room";
}
if(isset($_GET['computer_id']))
{
    $resource_id = $_GET['computer_id'];
    $resource_type = "Computer";
}
if(isset($_GET['program_id']))
{
    $resource_id = $_GET['program_id'];
    $resource_type = "Computer Program";
}
$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$email = $_SESSION['email'];
$name = $_SESSION['name'];
$stmt = $connection->prepare("SELECT student_id FROM students WHERE email_address = ? AND first_name = ?");
$stmt->bind_param("ss", $email, $name);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful
if ($result) {
    // Fetch the result
    if ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
    } else {
        echo "No student found with the provided email address and first name.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();

function check_card_validity($connection, $student_id, $resource_type) {
    $query = "SELECT * FROM cards WHERE student_id = $student_id AND resource_type = '$resource_type' AND status = 'Active'";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result) > 0;
}

function check_borrow_limit($connection, $student_id, $resource_type) {
    $max_limit = $resource_type == 'Book' ? 5 : 1; // Assuming non-university students can only borrow 1 item
    $query = "SELECT COUNT(*) as total FROM borrowed_resources WHERE card_id = (SELECT card_id FROM cards WHERE student_id = $student_id AND resource_type = '$resource_type' AND status = 'Active')";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] < $max_limit;
}

function get_first_available_copy($connection, $resource_id, $resource_type) {
    $copy_table = $resource_type == 'Book' ? 'book_copies' : 'magazine_copies';
    $resource_column = $resource_type == 'Book' ? 'book_id' : 'magazine_id';
    $query = "SELECT * FROM $copy_table WHERE $resource_column = $resource_id AND status = 'available' LIMIT 1";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resource_id = $_POST['resource_id'];
    $borrow_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime('+15 days'));

    if (!check_card_validity($connection, $student_id, $resource_type)) {
        ?>
        <br><br><center><span class="alert-danger">No valid card for this resource type. !!</span></center>
        <?php
    } elseif (!check_borrow_limit($connection, $student_id, $resource_type)) {
        ?>
        <br><br><center><span class="alert-danger">Borrow limit reached for this resource type. !!</span></center>
        <?php
    } else {
        $card_id_query = "SELECT card_id FROM cards WHERE student_id = $student_id AND resource_type = '$resource_type' AND status = 'Active'";
        $card_id_result = mysqli_query($connection, $card_id_query);
        $card_data = mysqli_fetch_assoc($card_id_result);
        $card_id = $card_data['card_id'];

        if ($resource_type == 'Book' || $resource_type == 'Magazine') {
            $copy = get_first_available_copy($connection, $resource_id, $resource_type);
            if ($copy) {
                $copy_id = $copy['copy_id'];
                $borrow_query = "INSERT INTO borrowed_resources (card_id, resource_id, borrow_date, return_date) VALUES ($card_id, $copy_id, '$borrow_date', '$return_date')";
                if (mysqli_query($connection, $borrow_query)) {
                    $update_copy_status_query = "UPDATE " . ($resource_type == 'Book' ? 'book_copies' : 'magazine_copies') . " SET status = 'borrowed' WHERE copy_id = $copy_id";
                    mysqli_query($connection, $update_copy_status_query);
                    ?>
                    <br><br><center><span class="alert-success">Resource borrowed successfully. !!</span></center>
                    <?php
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
            } else {
                echo "No available copies.";
            }
        }elseif ($resource_type == 'Meeting Room') {
            echo "<script>window.location.href = 'book_room.php?room_id=" . $resource_id . "';</script>";
        }
        
        else {
            $borrow_query = "INSERT INTO borrowed_resources (card_id, resource_id, borrow_date, return_date) VALUES ($card_id, $resource_id, '$borrow_date', '$return_date')";
            if (mysqli_query($connection, $borrow_query)) {
                ?>
                <br><br><center><span class="alert-success">Resource borrowed successfully. !!</span></center>
                <?php
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrow Resource</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Borrow Resource</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST">
                <input type="hidden" name="resource_id" value="<?php echo $resource_id; ?>">
                <input type="hidden" name="resource_type" value="<?php echo $resource_type; ?>">
                <button class="btn btn-primary" type="submit">Borrow</button>
            </form>
</body>
</html>
