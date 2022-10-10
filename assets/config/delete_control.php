<?php 
  require "../includes/sessions.php";
  require "dbconnect.php";
  
  if (!isset($_GET['del'])) {
    header("Location: logout");
  }else{
    $userId =  $_GET['del'];

    $sql = "DELETE FROM users WHERE id = '$userId'";
    $query = mysqli_query($connectDB,$sql);
    if (!$query) {
        $_SESSION['error_msg'] = "Opps, Something went wrong!";
        header("Location: ../../portal/dashboard");
    }else{
        $_SESSION['success_msg'] = "Records Deleted Successfully";
        header("Location: ../../portal/dashboard");
    }
  }
