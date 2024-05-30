<?php
    session_start();
    #fetch data from database
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $book_name = "";
    $author = "";
    $book_no = "";
    $student_name = "";
    $query = "select issued_books.book_name,issued_books.book_author,issued_books.book_no,users.name from issued_books left join users on issued_books.student_id = users.id where issued_books.status = 1";
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    <span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
        <center><h4>Issued Book's Detail</h4><br></center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form>
                    <table class="table-bordered" width="900px" style="text-align: center">
                        <tr>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Number</th>
                            <th>Student Name</th>
                        </tr>
                
                    <?php
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                            <td><?php echo $row['book_name'];?></td>
                            <td><?php echo $row['book_author'];?></td>
                            <td><?php echo $row['book_no'];?></td>
                            <td><?php echo $row['name'];?></td>
                        </tr>

                    <?php
                        }
                    ?>    
                </table>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
</body>
</html>
