<?php
require "../assets/includes/sessions.php";
require "../assets/config/dbconnect.php";
isLoggedIn();

// Current User Id
$uid = $_SESSION['user'];

// Prepared SQL Command
$sql = "SELECT * FROM users WHERE id = '$uid'";
// Query Database
$query = mysqli_query($connectDB, $sql);
// Convert  value to associative array
$userData = mysqli_fetch_assoc($query);
// print_r($userData);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Early-Money | Get it Sharp sharp</title>
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/lib/fontawsome/css/all.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <section>
        <?php include_once "../assets/includes/dash-nav.php"; ?>
        <?php echo errorMsg();
        echo successMsg(); ?>
    </section>
    <section>
        <div class="container p-2 p-md-5">
            <div class="card p-3 shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Account Profile</h2>
                    <form action="../assets/config/update_pic_config.php" method="post" enctype="multipart/form-data" >
                        <label for="pic">
                            <img src="../assets/img/avatars/<?php 
                                $img = $userData['prof_pic'];
                                if (empty($img)) {
                                   echo "user.png";
                                }else{
                                    echo "$img?".mt_rand();
                                }
                            ?>" alt="profile-picture" class="img-thumbnail d-block mx-auto">
                        </label>
                        <input type="file" name="file" id="pic" class="form-control d-none"> <br>
                        <input type="submit" name="resetPicture" value="Reset Picture" class="btn btn-primary ms-3 mt-3">
                        <input type="submit" name="updatePicture" value="Update Picture" class="btn btn-success ms-3 mt-3">
                    </form>
                </div>

                <form action="../assets/config/update_config.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" value="<?php echo $userData['account_uid']; ?> " class="form-control" disabled="true" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fname" value="<?php echo $userData['full_name']; ?> " class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="<?php echo $userData['email']; ?> " disabled="true" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $userData['phone']; ?> " required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="text" class="form-control" value="<?php echo $userData['dob']; ?> " disabled="true" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option selected><?php echo $userData['gender']; ?></option>
                                <option disabled>-----------</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="submit" name="update" value="Update" class="btn btn-dark">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        const message = document.querySelector("#messageAlert");

        if (message) {
            setTimeout(() => {
                message.classList.add("animate__animated", "animate__fadeOut");
                setTimeout(() => {
                    message.classList.add('d-none')
                }, 1000)
            }, 3000)
        }
    </script>
</body>

</html>