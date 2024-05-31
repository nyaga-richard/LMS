<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>
<?php include 'navtop.php'; ?>
    <span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
        <center><h4>Change Admin Password</h4><br></center>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="update_password.php" method="post">
                    <div class="form-group">
                        <label for="password">Enter Password:</label>
                        <input type="password" class="form-control" name="old_password">
                    </div>
                    <div class="form-group">
                        <label for="New Password">Enter New Password:</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Password</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
</body>
</html>
