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
      
    </section>
    <section>
        <div class="container p-2 p-md-5">
            <div class="card p-3 shadow">
            <?php echo errorMsg(); echo successMsg(); ?>
                <h2>Set Transfer Pin</h2>

                <form action="../assets/config/transfer_config.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Enter Pin</label>
                            <input type="password" name="pin" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm Pin</label>
                            <input type="password" name="conPin" class="form-control" required>
                        </div>

                        <div class="col-12 text-end">
                            <input type="submit" name="setPin" value="Set Pin" class="btn btn-secondary">

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