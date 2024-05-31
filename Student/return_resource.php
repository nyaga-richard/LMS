<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $borrow_id = $_POST['borrow_id'];
    $return_date = date('Y-m-d');

    // Update date_returned in borrowed_resources
    $update_query = "UPDATE borrowed_resources SET date_returned = ? WHERE borrow_id = ?";
    $stmt = $connection->prepare($update_query);
    $stmt->bind_param("si", $return_date, $borrow_id);
    $stmt->execute();

    // Check resource type and update availability if necessary
    $select_query = "
        SELECT br.resource_id, c.resource_type
        FROM borrowed_resources br
        JOIN cards c ON br.card_id = c.card_id
        WHERE br.borrow_id = ?
    ";
    $stmt = $connection->prepare($select_query);
    $stmt->bind_param("i", $borrow_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $resource_id = $row['resource_id'];
        $resource_type = $row['resource_type'];

        if ($resource_type === 'Book') {
            $update_copies_query = "UPDATE book_copies SET status = available WHERE copy_id = ?";
        } elseif ($resource_type === 'Magazine') {
            $update_copies_query = "UPDATE magazine_copies SET status = available  WHERE copy_id = ?";
        } elseif ($resource_type === 'Computer') {
            $update_copies_query = "UPDATE computers SET status = available WHERE computer_id = ?";
        } elseif ($resource_type === 'Meeting Room') {
            $update_copies_query = "UPDATE meeting_rooms SET available = 1 WHERE room_id = ?";
        } elseif ($resource_type === 'Computer Program') {
            $update_copies_query = "UPDATE computer_programs SET available = 1 WHERE program_id = ?";
        }

        $stmt = $connection->prepare($update_copies_query);
        $stmt->bind_param("i", $resource_id);
        $stmt->execute();
    }

    $stmt->close();
    mysqli_close($connection);

    // Redirect back to the issued resources page
    header("Location: view_issued_resources.php");
    exit;
}
?>
