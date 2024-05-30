<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $book_name = "";
    $book_no = "";
    $author_id = "";
    $cat_id = "";
    $book_price = "";
    $query = "select * from books where book_no = $_GET[bn]";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        $book_name = $row['book_name'];
        $book_no = $row['book_no'];
        $author_id = $row['author_id'];
        $cat_id = $row['cat_id'];
        $book_price = $row['book_price'];
    }
    if(isset($_POST['update'])){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "update books set book_name = '$_POST[book_name]',author_id = $_POST[author_id],cat_id = $_POST[cat_id],book_price = $_POST[book_price] where book_no = $_GET[bn]";
        $query_run = mysqli_query($connection,$query);
        header("location:manage_book.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    <center><h4>Edit Book</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="mobile">Book Number:</label>
                        <input type="text" name="book_no" value="<?php echo $book_no;?>" class="form-control" disabled required>
                    </div>
                    <div class="form-group">
                        <label for="email">Book Name:</label>
                        <input type="text" name="book_name" value="<?php echo $book_name;?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Author ID:</label>
                        <input type="text" name="author_id" value="<?php echo $author_id;?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Category ID:</label>
                        <input type="text" name="cat_id" value="<?php echo $cat_id;?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Book Price:</label>
                        <input type="text" name="book_price" value="<?php echo $book_price;?>" class="form-control" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Book</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>

