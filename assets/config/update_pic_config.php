<?php
    require "../includes/sessions.php";
    require "dbconnect.php";
    
    
    if (isset($_POST['updatePicture'])) {
         // Current User Id
         $uid = $_SESSION['user'];
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        
        
        // Type of Allowed Files
        $allowed = array("jpg","jpeg","png","gif");

        // Get the file Extension
        $ext = explode('.',$fileName);
        $ext = end($ext);
        $ext = strtolower($ext);

        if (!in_array($ext,$allowed)) {
            $_SESSION['error_msg'] = "Invalid File Format valid(jpg, jpeg, png, gif)";
            header("Location: ../../users/profile");
        }else{
            if ($fileError !=  0) {
                $_SESSION['error_msg'] = "File is corrupted";
                header("Location: ../../users/profile");
            }else{
                if($fileSize > 4000000){
                    $_SESSION['error_msg'] = "File to large max: 4mb";
                    header("Location: ../../users/profile");
                }else{
                    // Generate a new name for the file
                    $fileNewName = "avatar".$uid.'.'.$ext;
                    $location = "../img/avatars/";
                   if(file_exists($location.$fileNewName)){
                        unlink($location.$fileNewName); // This will delete the file

                        if (move_uploaded_file($fileTmpName,$location.$fileNewName)) {
                            $sql = "UPDATE users SET prof_pic = ? WHERE id = '$uid'";
                            $stmt = mysqli_stmt_init($connectDB);
                            mysqli_stmt_prepare($stmt,$sql);
                            mysqli_stmt_bind_param($stmt,"s",$fileNewName);
                            $execute = mysqli_stmt_execute($stmt);
                    
                            
                            if (!$execute) {
                                $_SESSION['error_msg'] = "Opps! Something went wrong";
                                header("Location: ../../users/profile");
                            }else{
                                $_SESSION['success_msg'] = "Update Successful!";
                                header("Location: ../../users/profile");
                            }
                        }
                   }else{
                        if (move_uploaded_file($fileTmpName,$location.$fileNewName)) {
                            $sql = "UPDATE users SET prof_pic = ? WHERE id = '$uid'";
                            $stmt = mysqli_stmt_init($connectDB);
                            mysqli_stmt_prepare($stmt,$sql);
                            mysqli_stmt_bind_param($stmt,"s",$fileNewName);
                            $execute = mysqli_stmt_execute($stmt);
                    
                            
                            if (!$execute) {
                                $_SESSION['error_msg'] = "Opps! Something went wrong";
                                header("Location: ../../users/profile");
                            }else{
                                $_SESSION['success_msg'] = "Update Successful!";
                                header("Location: ../../users/profile");
                            }
                        }
                   }
                }
            }
        }
    }
    elseif(isset($_POST['resetPicture'])){
        $uid = $_SESSION['user'];
        $sql = "SELECT * FROM users WHERE id = '$uid'";
        // Query Database
        $query = mysqli_query($connectDB, $sql);
        // Convert  value to associative array
        $userData = mysqli_fetch_assoc($query);

        $img = $userData['prof_pic'];
        if (unlink("../img/avatars/".$img)) {
            $sql = "UPDATE users SET prof_pic = '' WHERE id = '$uid'";
            $query = mysqli_query($connectDB,$sql);
            if (!$query) {
                $_SESSION['error_msg'] = "Opps! Something went wrong";
                header("Location: ../../users/profile");
            }else{
                $_SESSION['success_msg'] = "Image Reset Successful!";
                header("Location: ../../users/profile");
            }

        }
    }
    else{
        header("Location: logout");
    }