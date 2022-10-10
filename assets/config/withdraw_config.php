<?php
    require "../includes/sessions.php";
    require "dbconnect.php";
    $uid = $_SESSION['user'];
     
    if (isset($_POST['withdraw'])) {
        $acctNum = $_POST['acctNum'];
        $fname = $_POST['fname'];
        $amount = $_POST['amount'];
        $status = '0';

        // var_dump($_POST);
        $sql = "SELECT * FROM users WHERE id = '$uid'";
        $query = mysqli_query($connectDB, $sql);
        $row = mysqli_fetch_assoc($query);

        $curBal = $row['cur_balance'];

        if (empty($acctNum) || empty($fname) || empty($amount)) {
            $_SESSION['error_msg'] = "Values Cannot be empty!";
            header("Location: ../../users/withdraw");
        }
        elseif($curBal < $amount){
            $_SESSION['error_msg'] = "Insufficient Balance!";
            header("Location: ../../users/withdraw");
        }else{
            $sql = "INSERT INTO withdraw(acct_num,fname,amount,d_status) VALUES(?,?,?,?)";

            // Initialize connection with database
            $stmt = mysqli_stmt_init($connectDB);

            // Prepare Connection with SQL
            mysqli_stmt_prepare($stmt,$sql);
            // var_dump($stmt);

            // Bind the values that will be sent to the database
            mysqli_stmt_bind_param($stmt,"ssis",$acctNum,$fname,$amount,$status);

            $execute = mysqli_stmt_execute($stmt);
            
            if (!$execute) {
                $_SESSION['error_msg'] = "Opps! Something went wrong";
                header("Location: ../../users/withdraw");
            }else{
                $_SESSION['success_msg'] = "Withdrawal succesful, pending verification";
                header("Location: ../../users/withdraw");
            }
        }
    }
    elseif (isset($_GET['ver'])) {
        $id = $_GET['ver'];
        $acct = $_GET['acct'];
        $amount = $_GET['amt'];

        // Get User Current Balance
        $sql = "SELECT * FROM users WHERE account_uid = '$acct'";
        $query = mysqli_query($connectDB, $sql);
        $row = mysqli_fetch_assoc($query);

        $curBal = $row['cur_balance'];

        // Change the Status of the Transaction
        $sql = "UPDATE withdraw SET d_status = '1' WHERE id = '$id'";
        $query = mysqli_query($connectDB, $sql);

        if (!$query) {
            $_SESSION['error_msg'] = "Something went wrong!";
            header("Location: ../../portal/withdraw");
        }else{
            $bal = intval($curBal) - intval($amount);
            $sql = "UPDATE users SET cur_balance = '$bal' WHERE account_uid = '$acct'";
        $query = mysqli_query($connectDB, $sql);

        if (!$query) {
            $_SESSION['error_msg'] = "Something went wrong!";
            header("Location: ../../portal/withdraw");
        }else{
            $_SESSION['success_msg'] = "Verified Transaction!";
            header("Location: ../../portal/withdraw");
        }
        }
    }else{
        header('Location: ../../login');
    }
