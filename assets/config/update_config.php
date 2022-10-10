<?php
    require "../includes/sessions.php";
    require "dbconnect.php";

   
    if (!isset($_POST['update'])) {
        header("Location: logout");
    }else{
         // Current User Id
        $uid = $_SESSION['user'];
        $fullName = $_POST['fname'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $sql = "UPDATE users SET full_name = ?, phone = ?, gender = ? WHERE id = '$uid'";
        $stmt = mysqli_stmt_init($connectDB);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sss",$fullName,$phone,$gender);
        $execute = mysqli_stmt_execute($stmt);

        
        if (!$execute) {
            $_SESSION['error_msg'] = "Opps! Something went wrong";
            header("Location: ../../users/profile");
        }else{
            $_SESSION['fullName'] = $fullName;
            $_SESSION['success_msg'] = "Update Successful!";
            header("Location: ../../users/profile");
        }
    }