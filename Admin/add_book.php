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

    if(isset($_POST['add_book']))
    {
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $query = "INSERT INTO books (book_name, author_id, cat_id, book_no, description, image, book_price) 
        VALUES ('$_POST[book_name]', '$_POST[book_author]', '$_POST[book_category]', '$_POST[book_no]', '$_POST[book_description]', '$_POST[book_image]', '$_POST[book_price]')";
        $query_run = mysqli_query($connection,$query);
        if ($query_run) {
            echo "<script type='text/javascript'>
                    alert('Book added successfully');
                   
                  </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Error adding book: " . mysqli_error($connection) . "');
                  </script>";
        }
        #header("location:add_book.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include 'head.php'; ?>
    <script type="text/javascript">
          function alertMsg(){
              alert(Book added successfully...);
              window.location.href = "admin_dashboard.php";
          }
      </script>
    </head>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <center><h4>Add a new Book</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Book Name:</label>
                        <input type="text" name="book_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="book_author">Author ID:</label>
                        <select class="form-control" name="book_author">
                            <option>-Select author-</option>
                            <?php  
                                $connection = mysqli_connect("localhost","root","");
                                $db = mysqli_select_db($connection,"lms");
                                $query = "select author_id,author_name from authors";
                                $query_run = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($query_run)){
                                    ?>
                                    echo "<option value='<?php echo $row['author_id'];?>'>" <?php echo $row['author_name'];?> "</option>";
                                    <?php
                                }
                            ?>
                        </select>
                        <!--<input type="text" name="book_author" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label for="mobile">Category ID:</label>
                        <select class="form-control" name="book_category">
                            <option>-Select author-</option>
                            <?php  
                                $connection = mysqli_connect("localhost","root","");
                                $db = mysqli_select_db($connection,"lms");
                                $query = "select cat_id,cat_name from category";
                                $query_run = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($query_run)){
                                    ?>
                                    echo "<option value='<?php echo $row['cat_id'];?>'>" <?php echo $row['cat_name'];?> "</option>";
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="mobile">Book Number:</label>
                        <input type="text" name="book_no" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Description:</label>
                        <input type="textbox" name="book_description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Book Image:</label>
                        <input type="text" name="book_image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Book Price:</label>
                        <input type="text" name="book_price" class="form-control" required>
                    </div>
                    <button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>


