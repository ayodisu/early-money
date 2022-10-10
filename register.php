<?php 
    require_once "assets/includes/sessions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Early-Money | Get it Sharp sharp</title>
    <link rel="shortcut icon" href="assets/img/logo.png">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/lib/fontawsome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <section>
        <?php include_once "assets/includes/nav.php"; ?>
    </section>

    <section>
        <div class="container my-5">
            <form action="assets/config/register_config.php" method="post" class="card p-3 mx-auto shadow" style="max-width: 600px;">
                <?php echo errorMsg(); echo successMsg(); ?>
                <h4 class="card-title">Create an Account</h4>

                <input type="text" class="form-control mb-3" name="fname" placeholder="Full Name" required>
                <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
                <input type="tel" class="form-control mb-3" name="phone" placeholder="Phone Number" required>
                <input type="text" onfocus="this.type='date'" class="form-control mb-3" name="dob" placeholder="Date of Birth" required>
                <select name="gender" class="form-select mb-3">
                    <option selected disabled>Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <input type="password" class="form-control mb-3" name="pass" placeholder="Password" autocomplete="off" required>
                <input type="password" class="form-control mb-3" name="conpass" placeholder="Confirm Password" autocomplete="off" required>

                <div class="form-check my-3">
                    <input type="checkbox" id="check" name="approve" class="form-check-input" required>
                    <label for="check" class="form-check-label">Do you accept these Terms and Conditions ?</label>
                </div>

                <input type="submit" name="register" value="Create Account" class="btn btn-dark mb-3">

                <p>
                    Already have an account? <a href="login" class="text-decoration-none">Login</a>
                </p>
            </form>
        </div>
    </section>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>



</html>