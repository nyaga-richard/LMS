<?php
    require("functions.php");
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $name = "";
    $email = "";
    $mobile = "";
    $query = "select * from admins where email = '$_SESSION[email]'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Manage Books</h4><br></center>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>ISBN No.</th>
                            <th>No of copies</th>
                            <th>Price</th>
                            <th>Action</th>
                            <th>Delete Action</th>
                        </tr>
                    </thead>
                    <?php
                        $connection = mysqli_connect("localhost","root","");
                        $db = mysqli_select_db($connection,"lms");
                        $query = "
                        SELECT 
                            books.book_id,
                            books.book_name, 
                            books.author_id, 
                            books.cat_id, 
                            books.book_no,   
                            books.book_price,
                            COUNT(book_copies.copy_id) AS num_copies
                        FROM books
                        LEFT JOIN book_copies ON books.book_id = book_copies.book_id
                        GROUP BY books.book_no
                    ";
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                                <td><?php echo $row['book_name'];?></td>
                                <td><?php echo $row['author_id'];?></td>
                                <td><?php echo $row['cat_id'];?></td>
                                <td><?php echo $row['book_no'];?></td>
                                <td><?php echo $row['num_copies']; ?></td>
                                <td><?php echo $row['book_price'];?></td>
                                <td>
                                <button class="btn">
                                    <a class="btn btn-primary" href="edit_book.php?bn=<?php echo $row['book_no'];?>">Edit</a>
                                </button>
                                <button class="btn">
                                    <a class="btn btn-success" href="add_copies.php?bn=<?php echo $row['book_id'];?>&bname=<?php echo urlencode($row['book_name']);?>">Manage copies</a>
                                </button>
                                </td>
                                <td>
                                <button class="btn">
                                    <a class="btn btn-danger" href="delete_book.php?bn=<?php echo $row['book_id'];?>&action=delete_all">Delete All Copies</a>
                                </button>
                                <button class="btn">
                                    <a class="btn btn-warning" href="delete_book.php?bn=<?php echo $row['book_id'];?>&action=delete_copy">Delete Copy</a>
                                </button>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
</body>
</html>
