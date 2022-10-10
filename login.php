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
            <form action="assets/config/login_config.php" method="post" class="card p-3 mx-auto shadow" style="max-width: 600px;">
                <?php echo errorMsg(); echo successMsg(); ?>
                <h4 class="card-title">Login to your account</h4>

                <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
                <input type="password" class="form-control mb-3" name="pass" placeholder="Password" autocomplete="off" required>

                <input type="submit" name="login" value="Login" class="btn btn-dark mb-3">

                <p>
                    Don't have an account? <a href="register" class="text-decoration-none">Create Account</a>
                </p>
            </form>
        </div>
    </section>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        const message = document.querySelector("#messageAlert");

        if (message) {
            setTimeout(()=>{
               message.classList.add("animate__animated","animate__fadeOut");
                setTimeout(()=>{
                    message.classList.add('d-none')
                },1000)
           },3000)
        }
    </script>
</body>

</html>