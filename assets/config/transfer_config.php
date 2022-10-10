<?php
    require "../includes/sessions.php";
    require "dbconnect.php";

    if (isset($_POST['transfer'])) {
        $acctNum = $_POST['acctNum'];
        $desc = $_POST['desc'];
        $amount = $_POST['amount'];
        $pin = $_POST['pin'];

        $uid = $_SESSION['user'];

        // Get User Current Balance
        $sql = "SELECT * FROM users WHERE id = '$uid'";
        $query = mysqli_query($connectDB, $sql);
        $row = mysqli_fetch_assoc($query);

        $senderBal = $row['cur_balance'];
        $sendAcct = $row['account_uid'];
        $valPin = $row['val_pin'];
        
        // Check if user already has a pin set
        if (empty($valPin)) {
            $_SESSION['error_msg'] = "Please set your transfer pin!";
            header('Location: ../../users/settings');
        }

        // Check if the Account number exist
        $sql = "SELECT * FROM users WHERE account_uid = ?";
        $stmt = mysqli_stmt_init($connectDB);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$acctNum);
        $execute = mysqli_stmt_execute($stmt);
   
        $result = mysqli_stmt_get_result($stmt);

        $numRows = mysqli_num_rows($result);

        if ($numRows != 1 || $acctNum === $row['account_uid']) {
            $_SESSION['error_msg'] = "Invalid Account Number!";
            header('Location: ../../users/transfer');
        }
        // elseif($senderBal > $amount && $senderBal > 1000){
        elseif($amount >= 1000000){
            $_SESSION['error_msg'] = "Transfer Limit passsed, limit: ₦ 1,000,000.00!";
            header('Location: ../../users/transfer');
        }
        elseif($senderBal <= $amount){
            $_SESSION['error_msg'] = "Insufficient Balance!";
            header('Location: ../../users/transfer');
        }
        elseif (!password_verify($pin, $row['val_pin'])) {
            $_SESSION['error_msg'] = "Incorrect Pin!";
            header('Location: ../../users/transfer');
        }
        else{
            // Get The recievers Balance
            $rec = mysqli_fetch_assoc($result);

            $recBal = $rec['cur_balance'];

            $recBal = intval($recBal) + intval($amount);
            $senderBal = intval($senderBal) - intval($amount);

            $sql = "UPDATE users SET cur_balance = '$senderBal' WHERE id = '$uid'";
            $query = mysqli_query($connectDB, $sql);
            if (!$query) {
                $_SESSION['error_msg'] = "Transaction Error!";
                header('Location: ../../users/transfer');
            }else{
                
                $sql = "UPDATE users SET cur_balance = '$recBal' WHERE account_uid = '$acctNum'";
                $query = mysqli_query($connectDB, $sql);
                if (!$query) {
                    $_SESSION['error_msg'] = "Transaction Error!";
                    header('Location: ../../users/transfer');
                }else{
                    $sql = "INSERT INTO transfers(userid,send_acct,rec_acct,descr,amount) VALUES(?,?,?,?,?)";

                    // Initialize connection with database
                    $stmt = mysqli_stmt_init($connectDB);

                    // Prepare Connection with SQL
                    mysqli_stmt_prepare($stmt,$sql);
                    // var_dump($stmt);

                    // Bind the values that will be sent to the database
                    mysqli_stmt_bind_param($stmt,"ssssi",$uid,$sendAcct,$acctNum,$desc,$amount);

                    $execute = mysqli_stmt_execute($stmt);
                    
                    if (!$execute) {
                        $_SESSION['error_msg'] = "Opps! Something went wrong";
                        header("Location: ../../users/transfer");
                    }else{
                        $_SESSION['success_msg'] = "Transfer Successful!";
                        header("Location: ../../users/transfer");
                    }
                }
            }
        }
    }

    elseif(isset($_POST['setPin'])){
        $uid = $_SESSION['user'];
        $pin = $_POST['pin'];
        $conPin = $_POST['conPin'];

        if (strlen($pin) != 4 ) {
            $_SESSION['error_msg'] = "Pin must be 4 values!";
            header("Location: ../../users/settings");
         }
         elseif($pin != $conPin){
             $_SESSION['error_msg'] = "Pins do not match!";
             header("Location: ../../users/settings");
            }else{
                // Encrypt the pin
                $pin = password_hash($pin, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET val_pin = ? WHERE id = '$uid'";
                $stmt = mysqli_stmt_init($connectDB);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"s",$pin);
                $execute = mysqli_stmt_execute($stmt);

                
                if (!$execute) {
                    $_SESSION['error_msg'] = "Opps! Something went wrong";
                    header("Location: ../../users/settings");
                }else{
                    $_SESSION['success_msg'] = "Pin Set Successfully!";
                    header("Location: ../../users/settings");
                }
         }
    }