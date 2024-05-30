<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Issue Book</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="book_name">Book Name:</label>
                        <input type="text" name="book_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="book_author">Author ID:</label>
                        <select class="form-control" name="book_author">
                            <option>-Select author-</option>
                            <?php  
                                $connection = mysqli_connect("localhost","root","");
                                $db = mysqli_select_db($connection,"lms");
                                $query = "select author_name from authors";
                                $query_run = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($query_run)){
                                    ?>
                                    <option><?php echo $row['author_name'];?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <!--<input type="text" name="book_author" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label for="book_no">Book Number:</label>
                        <input type="text" name="book_no" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Student ID:</label>
                        <input type="text" name="student_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="issue_date">Issue Date:</label>
                        <input type="text" name="issue_date" class="form-control" value="<?php echo date("yy-m-d");?>" required>
                    </div>
                    <button type="submit" name="issue_book" class="btn btn-primary">Issue Book</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>

<?php
    if(isset($_POST['issue_book']))
    {
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "insert into issued_books values(null,$_POST[book_no],'$_POST[book_name]','$_POST[book_author]',$_POST[student_id],1,'$_POST[issue_date]')";
        $query_run = mysqli_query($connection,$query);
        #header("Location:admin_dashboard.php");
    }
?>
