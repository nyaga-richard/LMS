<?php
    require("functions.php");
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!-- <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
      <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script> -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
            </div>
            <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
            <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="view_profile.php">View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="change_password.php">Change Password</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
              </li>
            </ul>
        </div>
    </nav><br>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
        <div class="container-fluid">
            
            <ul class="nav navbar-nav navbar-center">
              <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Books </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add_book.php">Add New Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="manage_book.php">Manage Books</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Category </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add_cat.php">Add New Category</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="manage_cat.php">Manage Category</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Authors</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add_author.php">Add New Author</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="manage_author.php">Manage Author</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="issue_book.php">Issue Book</a>
              </li>
            </ul>
        </div>
    </nav><br>
    <div class="row">
        <div class="col-md-3" style="margin: 0px ">
            <div class="card bg-light" style=" width: 300px ">
                <div class="card-header">Registered User</div>
                <div class="card-body">
                    <p class="card-text">No. total Users: <?php echo get_user_count();?></p>
                    <a class="btn btn-danger" href="Regusers.php" target="_blank">View Registered Users</a>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="margin: 0px">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header">Total Book</div>
                <div class="card-body">
                    <p class="card-text">No of books available: <?php echo get_book_count();?></p>
                    <a class="btn btn-success" href="Regbooks.php" target="_blank">View All Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="margin: 0px">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header">Book Categories</div>
                <div class="card-body">
                    <p class="card-text">No of Book's Categories: <?php echo get_category_count();?></p>
                    <a class="btn btn-warning" href="Regcat.php" target="_blank">View Categories</a>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="margin: 0px">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header">No. of Authors</div>
                <div class="card-body">
                    <p class="card-text">No of Authors: <?php echo get_author_count();?></p>
                    <a class="btn btn-primary" href="Regauthor.php" target="_blank">View Authors</a>
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="row">
        <div class="col-md-3" style="margin: 0px">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header">Book Issued</div>
                <div class="card-body">
                    <p class="card-text">No of book issued: <?php echo get_issue_book_count();?></p>
                    <a class="btn btn-success" href="view_issued_book.php" target="_blank">View Issued Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
</body>
</html>
