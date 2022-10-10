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


                <h2>Transfer</h2>
                <h3 class="d-flex gap-2 align-items-center">
                    Current Balance:  ₦
                    <a href="#" id="show" onclick="hideShow(event,'hide')"  class="text-decoration-none">
                        <?php echo number_format($userData['cur_balance'],2,'.',','); ?>
                    </a>
                    <a href="#" id='hide' onclick="hideShow(event,'show')"  class="text-decoration-none d-none ">
                        ******
                    </a>
                </h3>

                <form action="../assets/config/transfer_config.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="acctNum" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" name="desc" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" placeholder="min:100" class="form-control" min="100"
                                required>
                        </div>

                        <div class="col-12 text-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Proceed
                            </button>

                            <!-- Modal -->
                            <div class="modal fade bg-black" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header text-start">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Enter pin</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                           <h3>Enter Pin</h3>
                                           <input type="password" name="pin" minlength="4" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                                <input type="submit" name="transfer" value="Transfer" class="btn btn-secondary">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <?php if(!isset($_GET['t'])) { ?>
                <div class="table-responsive mt-5">
                    <div class="text-end">
                        <a href="transfer?t=credit" class="btn btn-primary">
                            Credits
                        </a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Acct Num</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Type</th>
                                <th scope="col">Descr</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $acct = $userData['account_uid'];
                                $sql = "SELECT * FROM transfers WHERE send_acct = '$acct' ORDER BY id DESC";
                                $query = mysqli_query($connectDB,$sql);                         
                                while ($row = mysqli_fetch_assoc($query)) { 
                            ?>
                            <tr>

                                <th scope="row"> <?php echo $row['rec_acct']; ?></th>
                                <td> ₦ <?php echo number_format($row['amount'], 2, '.', ','); ?></td>
                                <td scope="row"><?php echo ($row['send_acct'] == $acct)?"Debit":"Credit"; ?></td>
                                <td><?php echo $row['descr']; ?></td>
                                <td><?php
                                    $date = date_create($row['date_created']);

                                    echo date_format($date,"M d. Y h:i a");
                                ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                    <div class="table-responsive mt-5">
                    <div class="text-end">
                        <a href="transfer" class="btn btn-danger">
                            Debits
                        </a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Acct Num</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Type</th>
                                <th scope="col">Descr</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $acct = $userData['account_uid'];
                                $sql = "SELECT * FROM transfers WHERE rec_acct = '$acct' ORDER BY id DESC";
                                $query = mysqli_query($connectDB,$sql);                         
                                while ($row = mysqli_fetch_assoc($query)) { 
                            ?>
                            <tr>

                                <th scope="row"> <?php echo $row['send_acct']; ?></th>
                                <td> ₦ <?php echo number_format($row['amount'], 2, '.', ','); ?></td>
                                <td scope="row"><?php echo ($row['send_acct'] == $acct)?"Debit":"Credit"; ?></td>
                                <td><?php echo $row['descr']; ?></td>
                                <td><?php 
                                  $date = date_create($row['date_created']);

                                  echo date_format($date,"M d. Y h:i a");
                                ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php } ?>
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

        function hideShow(event,next){
            document.getElementById(next).classList.toggle('d-none')
            event.target.classList.toggle('d-none')
        }
    </script>

</body>

</html>