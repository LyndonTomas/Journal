<?php
    include ('init.php');
    if(!isset($_GET['id'])){
        $error_message = "Invalid input! Guest ID is required.";
    }

    else{
        $guest_id = $_GET['id'];
        $statement = mysqli_prepare($conn, 'DELETE FROM journal WHERE id = ?');
        mysqli_stmt_bind_param($statement, 'i', $guest_id);
        if(mysqli_stmt_execute($statement)){
            header("Location: display.php");
        }
        else{
            $error_message = "Guest deletion failed. Try again!";
        }
    }
?>