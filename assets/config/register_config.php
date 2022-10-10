<?php
    require "../includes/sessions.php";
    require "dbconnect.php";

    date_default_timezone_set("Africa/Lagos");
  
    // Check if the button is clicked or set
    if (!isset($_POST['register'])) {   //isset checks if a value has been declared and its not equal to null
        // $_SESSION['error_msg'] = "Please Create an Account to Continue";
        header("Location: ../../register");
    }else{
        $uid = "EM".rand(1000000,9999999);
        $fullName = $_POST['fname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $pass = $_POST['pass'];
        $conpass = $_POST['conpass'];
        $role = "user";
        $date = date("Y-m-d");
        $hash = password_hash($pass, PASSWORD_DEFAULT); // Encrypt users Password

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($connectDB);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$email);
        $execute = mysqli_stmt_execute($stmt);
   
        $result = mysqli_stmt_get_result($stmt);

        $numRows = mysqli_num_rows($result);

        if ($numRows > 0) {
            $_SESSION['error_msg'] = "This email already exists!";
            header("Location: ../../login");
        }
        elseif (strlen($pass) < 8) {
           $_SESSION['error_msg'] = "Password must be at least 8 characters!";
           header("Location: ../../register");
        }
        elseif($pass != $conpass){
            $_SESSION['error_msg'] = "Passwords do not match!";
            header("Location: ../../register");
        }else{
            // Prepare SQL Statement
            $sql = "INSERT INTO users(account_uid,full_name,email,phone,dob,gender,passwords,user_role,date_created) VALUES(?,?,?,?,?,?,?,?,?)";

            // Initialize connection with database
            $stmt = mysqli_stmt_init($connectDB);

            // Prepare Connection with SQL
            mysqli_stmt_prepare($stmt,$sql);
            // var_dump($stmt);

            // Bind the values that will be sent to the database
            mysqli_stmt_bind_param($stmt,"sssssssss",$uid,$fullName,$email,$phone,$dob,$gender,$hash,$role,$date);

            $execute = mysqli_stmt_execute($stmt);

            if (!$execute) {
                $_SESSION['error_msg'] = "Opps! Something went wrong";
                header("Location: ../../register");
            }else{  
                $_SESSION['success_msg'] = "Registration Successful!";
                header("Location: ../../register");
            }
        }
        
    }
