<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Books</title>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Browse Books</h4><br></center>
        <div class="row" >
        <div class="col-md-1" ></div>
        <div class="col-md-10" >
        <div class="row row-cols-1 row-cols-md-2" >
        <?php
        $connection = mysqli_connect("localhost", "root", "", "lms");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT b.book_id As ID , b.book_name, a.author_name, b.publisher,b.description, b.image, COUNT(bc.copy_id) - COUNT(br.borrow_id) AS available_copies
        FROM books b
        LEFT JOIN authors a ON b.author_id = a.author_id
        LEFT JOIN book_copies bc ON b.book_id = bc.book_id
        LEFT JOIN borrowed_resources br ON bc.copy_id = br.resource_id AND br.return_date IS NULL
        GROUP BY b.book_id";
        
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class=\"card mb-3\" style=\"max-width: 700px; \">
                    <div class=\"row no-gutters\">
                        <div class=\"col-md-4\"style=\"max-width: 130px; padding: 10px\">
                            <img src=\"../book_images/" . htmlspecialchars($row['image']) . "\" class=\"card-img\" alt=\"Book image\">
                        </div>
                        <div class=\"col-md-8\">
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">" . htmlspecialchars($row['book_name']) . "</h5>
                                <p class=\"card-text\">" . htmlspecialchars($row['description']) . "</p>
                                <div class=\"d-flex w-100 justify-content-between\">
                                <p class=\"card-text\"><small class=\"text-muted\">" . htmlspecialchars($row['available_copies']) . " available copies</small></p>
                                <p class=\"card-text\"><small class=\"text-muted\"> Authored by: " . htmlspecialchars($row['author_name']) . "</small></p>
                                <p class=\"card-text\"><small class=\"text-muted\"> Published by: " . htmlspecialchars($row['publisher']) . " </small></p>
                                </div>                             
                                <a href=\"request_booking.php?book_id=" . htmlspecialchars($row['ID']) . "\" class=\"btn btn-primary\">Borrow</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br></br>";
            }
            
                
            //     <tr>
            //             <td>{$row['book_name']}</td>
            //             <td>{$row['author_name']}</td>
            //             <td>{$row['publisher']}</td>
            //             <td>{$row['available_copies']}</td>
            //           </tr>";
            // }
        } else {
            echo "<tr><td colspan='4'>No books available.</td></tr>";
        }

        mysqli_close($connection);
        ?>
                </div>
                </div>
            <div class="col-md-1"></div>
        </div>
</body>
</html>
