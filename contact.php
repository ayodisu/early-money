<?php require "assets/includes/sessions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Early Money</title>
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/lib/fontawsome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<section>
        <?php include_once "assets/includes/nav.php"; ?>
    </section>

    <section>
        <h2 class = "text-center pt-3">Contact Us</h2>
        <div class = "card mx-auto p-3 shadow" style="max-width: 700px;">
        <?php echo successMsg(); echo errorMsg(); ?>
        <p class = "text-center"><b>Our support team is always available to attend to your queries</b> <br>
            <br> +234(0)0700000000<br>support@earlymoney.com
        </p>
            <form action="assets\config\contact_config.php" method = "POST">
                <input type="text"  class="form-control mb-3" name= "fname" placeholder="Full name">
                <input type="text" class="form-control mb-3"  name= "subject" placeholder="Subject">
                <input type="email" class="form-control mb-3"  name= "email" placeholder="Email">
                <textarea class="form-control mb-3" name= "message" placeholder="Message..."  id="editor" style="height: 250px;"></textarea>
                <input type="Submit" value = "Send"  name= "Send" class = "btn btn-warning btn-lg my-3 text-end border">
            </form>
        </div>
    </section>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/ckeditor5/build/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

</body>
</html>