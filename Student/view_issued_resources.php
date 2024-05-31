<?php
require("functions.php");
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = get_student_id($_SESSION['name'], $_SESSION['email']);

$query = "
    SELECT 
        br.borrow_id,
        br.borrow_date,
        br.return_date,
        br.date_returned,
        c.resource_type,
        CASE 
            WHEN c.resource_type = 'Book' THEN b.book_name
            WHEN c.resource_type = 'Magazine' THEN m.title
            WHEN c.resource_type = 'Computer' THEN comp.computer_name
            WHEN c.resource_type = 'Meeting Room' THEN mr.room_number
            WHEN c.resource_type = 'Computer Program' THEN cp.program_name
        END AS resource_name,
        CASE 
            WHEN c.resource_type = 'Book' THEN a.author_name
            WHEN c.resource_type = 'Magazine' THEN m.editor
        END AS additional_info
    FROM 
        borrowed_resources br
        JOIN cards c ON br.card_id = c.card_id
        LEFT JOIN book_copies bc ON br.resource_id = bc.copy_id AND c.resource_type = 'Book'
        LEFT JOIN books b ON bc.book_id = b.book_id
        LEFT JOIN authors a ON b.author_id = a.author_id
        LEFT JOIN computers comp ON br.resource_id = comp.computer_id AND c.resource_type = 'Computer'
        LEFT JOIN meeting_rooms mr ON br.resource_id = mr.room_id AND c.resource_type = 'Meeting Room'
        LEFT JOIN magazine_copies mc ON br.resource_id = mc.copy_id AND c.resource_type = 'Magazine'
        LEFT JOIN magazines m ON mc.magazine_id = m.magazine_id
        LEFT JOIN computer_programs cp ON br.resource_id = cp.program_id AND c.resource_type = 'Computer Program'
    WHERE 
        c.student_id = ?
";

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Issued Resources</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Issued Resources</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Borrow ID</th>
                    <th>Resource Type</th>
                    <th>Resource Name</th>
                    <th>Author/Editor</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['borrow_id']; ?></td>
                        <td><?php echo $row['resource_type']; ?></td>
                        <td><?php echo $row['resource_name']; ?></td>
                        <td><?php echo isset($row['additional_info']) ? $row['additional_info'] : 'N/A'; ?></td>
                        <td><?php echo $row['borrow_date']; ?></td>
                        <td><?php echo $row['return_date']; ?></td>
                        <td>
                            <?php if (is_null($row['date_returned'])): ?>
                                <form action="return_resource.php" method="POST">
                                    <input type="hidden" name="borrow_id" value="<?php echo $row['borrow_id']; ?>">
                                    <button type="submit" class="btn btn-primary">Return</button>
                                </form>
                            <?php else: ?>
                                Returned
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
mysqli_close($connection);
?>
