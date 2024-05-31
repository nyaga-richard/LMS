<?php
    function get_author_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $author_count = 0;
        $query = "select count(*) as author_count from authors";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $author_count = $row['author_count'];
        }
        return($author_count);
    }

    function get_user_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $user_count = 0;
        $query = "select count(*) as user_count from users";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $user_count = $row['user_count'];
        }
        return($user_count);
    }

    function get_book_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $book_count = 0;
        $query = "select count(*) as book_count from books";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $book_count = $row['book_count'];
        }
        return($book_count);
    }
    function get_user_issue_book_count() {
        $connection = mysqli_connect("localhost", "root", "", "lms");
    
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        $user_issue_book_count = 0;
        $id = get_student_id($_SESSION['name'], $_SESSION['email']);
    
        // Prepared statement to avoid SQL injection
        $stmt = $connection->prepare("SELECT card_id FROM cards WHERE student_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $stmt2 = $connection->prepare("SELECT COUNT(*) as user_issue_book_count FROM borrowed_resources WHERE card_id = ?");
            $stmt2->bind_param("i", $row['card_id']);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
    
            if ($row2 = $result2->fetch_assoc()) {
                $user_issue_book_count += $row2['user_issue_book_count'];
            }
            $stmt2->close();
        }
    
        $stmt->close();
        mysqli_close($connection);
    
        return $user_issue_book_count;
    }

    function get_issue_book_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $issue_book_count = 0;
        $query = "select count(*) as issue_book_count from issued_books";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $issue_book_count = $row['issue_book_count'];
        }
        return($issue_book_count);
    }
    function get_student_issue_resource_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $issue_book_count = 0;
        $query = "select count(*) as issue_book_count from borrowed_resources";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $issue_book_count = $row['issue_book_count'];
        }
        return($issue_book_count);
    }

    function get_category_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $cat_count = 0;
        $query = "select count(*) as cat_count from category";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $cat_count = $row['cat_count'];
        }
        return($cat_count);
    }
    function get_student_id($name, $email){
        $connection = mysqli_connect("localhost","root","","lms");
        $stmt = $connection->prepare("SELECT student_id FROM students WHERE email_address = ? AND first_name = ?");
        $stmt->bind_param("ss", $email, $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            if ($row = $result->fetch_assoc()) {
                $student_id = $row['student_id'];
            } else {
                echo "No student found with the provided email address and first name.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        return($student_id);
    }
?>
