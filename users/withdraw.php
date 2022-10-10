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
                <h2>Withdraw</h2>
                <form action="../assets/config/withdraw_config.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" value="<?php echo $userData['account_uid']; ?>" name="acctNum" class="form-control" readonly="true" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Name</label>
                            <input type="text" value="<?php echo $userData['full_name']; ?> " name="fname" class="form-control" readonly="true" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" placeholder="min:1000" class="form-control" min="1000" required>
                        </div>

                        <div class="col-12">
                            <input type="submit" name="withdraw" value="Withdraw" class="btn btn-dark">
                        </div>
                    </div>
                </form>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Acct Num</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $acct = $userData['account_uid'];
                            $sql = "SELECT * FROM withdraw WHERE acct_num = '$acct' ORDER BY id DESC";
                            $query = mysqli_query($connectDB, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $row['acct_num']; ?></th>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td> ₦ <?php echo number_format($row['amount'], 2, '.', ','); ?></td>
                                    <td><?php echo ($row['d_status'] == '0') ? 'pending' : 'successful'; ?></td>
                                    <td><?php echo $row['date_created']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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