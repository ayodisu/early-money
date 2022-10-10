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
    <section class="container mt-5">
        <div class="d-flex justify-content-end">
            <div class="card p-5 shadow">
                <h1>Total Users</h1>
                <!-- Get Total Users -->
                <?php
                    $sql = "SELECT * FROM users WHERE user_role = 'user' ORDER BY id DESC LIMIT 200";
                    $query = mysqli_query($connectDB, $sql);
                    // $row = mysqli_fetch_assoc($query);
                ?>
                <h2 class="text-center"><?php echo mysqli_num_rows($query); ?></h2>
            </div>

        </div>
        <div class="card table-responsive mt-4 shadow p-2">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Acct Num</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Balance</th>
                        <th scope="col">---</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                            <th scope="row"><?php echo $row['account_uid']; ?></th>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td> ₦ <?php echo number_format($row['cur_balance'],2,'.',','); ?></td>
                            <td>
                                <a href="user_profile" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>


                                <a href="../assets/config/delete_control?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete <?php echo strtoupper($row['full_name']); ?> account?')"><i class="fa fa-trash"></i></a>

                                <a href="../assest/portal/user_pprofile?Go=<?php echo $row['id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to delete <?php echo strtoupper($row['full_name']); ?> account?')"><i class="fa fa-eye"></i></a>
                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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