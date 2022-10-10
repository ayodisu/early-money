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
            <div class="row justify-content-evenly align-items-end">
                <div class="col-md-6 mb-3">
                    <div class="card shadow p-3">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="fw-bold text-uppercase">Account No: </h5>
                                <h5 class="fw-bold text-uppercase">Account Name:</h5>
                            </div>
                            <div class="col-6">
                                <h5> <?php echo $userData['account_uid']; ?> </h5>
                                <h5> <?php echo ucwords($userData['full_name']); ?> </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card shadow p-3">
                        <h4>Current Balance:</h4>
                        <h4>₦ <?php echo number_format($userData['cur_balance'],2,'.',','); ?></h4>
                    </div>
                </div>
            </div>

            <div class="table-responsive card p-3 shadow">
                <h3 class="py-4">Transaction History</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Ref</th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Account No</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount (₦)</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ref</td>
                            <td>Account Name</td>
                            <td>Account No</td>
                            <td>Type</td>
                            <td>Amount (₦)</td>
                            <td>Date</td>
                        </tr>
                    </tbody>
                </table>
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