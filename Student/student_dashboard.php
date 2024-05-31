<?php
   require("functions.php");
    session_start();

    ?>
    
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <?php include 'head.php'; ?>
</head>
<style type="text/css">
    body{
      background: rgba(245, 245, 245, 0.4);
      background-image: url("https://img.freepik.com/free-photo/abundant-collection-antique-books-wooden-shelves-generated-by-ai_188544-29660.jpg?size=626&amp;ext=jpg&amp;ga=GA1.1.1546980028.1704240000&amp;semt=sph");
   }
</style>
<body>
<?php include 'navtop.php'; ?>
<?php include 'navbar.php'; ?>
    <div class="row">
        <div class="col-md-3" style="margin: 25px">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header">resources Issued</div>
                <div class="card-body">
                    <p class="card-text">No of resources issued: <?php echo get_user_issue_book_count();?></p>
                    <a class="btn btn-success" href="view_issued_resources.php">View Issued Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
</body>
</html>
