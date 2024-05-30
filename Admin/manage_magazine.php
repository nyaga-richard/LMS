<?php
 require("functions.php");
 session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");


// Adding new copies
if (isset($_POST['add_copies'])) {
    $magazine_id = $_POST['magazine_id'];
    $purchase_date = $_POST['purchase_date'];
    $num_copies = $_POST['num_copies'];

    for ($i = 0; $i < $num_copies; $i++) {
        $query = "INSERT INTO magazine_copies (magazine_id, purchase_date) VALUES ('$magazine_id','$purchase_date')";
        mysqli_query($connection, $query);
    }

    echo "<script>alert('Copies added successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Magazines</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navtop.php'; ?>
    <?php include 'navbar.php'; ?>
    <center><h4>Manage Magazines</h4><br></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edition Number</th>
                        <th>Publication Date</th>
                        <th>Publisher</th>
                        <th>Editor</th>
                        <th>Copies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT m.*, COUNT(mc.copy_id) AS copies_count FROM magazines m
                              LEFT JOIN magazine_copies mc ON m.magazine_id = mc.magazine_id
                              GROUP BY m.magazine_id";
                    $query_run = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $magazine_id = $row['magazine_id'];
                        $title = $row['title'];
                        ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['edition_number']; ?></td>
                            <td><?php echo $row['publication_date']; ?></td>
                            <td><?php echo $row['publisher']; ?></td>
                            <td><?php echo $row['editor']; ?></td>
                            <td><?php echo $row['copies_count']; ?></td>
                            <td>
                            <button class="btn">
                                <a href="edit_magazine.php?magazine_id=<?php echo $magazine_id; ?>&title=<?php echo $title; ?>" >edit</a>
                            </button>
                            <button class="btn">
                                <a href="add_magazine_copies.php?magazine_id=<?php echo $magazine_id; ?>&title=<?php echo $title; ?>" >Add Copies</a>
                            </button>
                               <td>
                            <td>
                                <button class="btn">
                                    <a href="delete_magazine.php?magazine_id=<?php echo $magazine_id;?>&action=delete_all" onclick="return confirm('Are you sure you want to delete all copies?');">Delete All Copies</a>
                                </button>
                                <button class="btn">
                                    <a href="delete_magazine.php?magazine_id=<?php echo $magazine_id;?>&action=delete_copy">Delete Copy</a>
                                </button>
                                </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</body>
</html>

