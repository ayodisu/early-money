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
     
    <section class="bg-light text-dark p-5 text-centertext-sm-start" id="section">
        <div class="container">
            <div class='d-sm-flex justify-content-between align-items-center '>
                <div class="mt-5 " >
                    <h1 class='text-capitalize fw-bold  '>Store <br> your money <br> the easy way</h1>
                    <p class="lead">Simple,Secure and Easy</p>

                   <a href="register"> <div class="btn btn-dark  btn-lg">Get started</div></a>

                       <h6 class="mt-4 fw-bold"> Available in</h6>
                        <div class="d-flex gap-4" id="google">
                          <a href=""><img src="assets/img/google.png" alt=""></a> 
                           <a href=""><img src="assets/img/apple.png" alt="" class="h-50 mt-2" ></a>
                        
                      
                    </div>
                </div>
                <img  src="assets/img/savings.png" alt=""  >
            </div>
        </div>
    </section>
    <section class="p-5">
        <div class="container">
             <!-- <h2 class="text-center ">Spend less time worrying <br> and more time living life.</h2> -->
            <div class="row text-center mt-3">
                <div class="col-md">
                    <div class="card bg-light text-dark">
                        <div class="card-body text-center shadow">
                            <div class="h1 mb-3">
                            <i class="fa fa-clock"></i>
                             </div>
                             <h3 class="card-title mb-3">
                                 Fast
                             </h3>
                             <p class="card-text">
                                Funding in less than <br> 24 hours
                             </p>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-light text-dark">
                        <div class="card-body text-center shadow">
                        <div class="h1 mb-3">
                        <i class="far fa-sticky-note"></i>
                             </div>
                             <h3 class="card-title mb-3  ">
                                 Simple
                             </h3>
                             <p class="card-text">
                                Short,quick <br> website.
                             </p>
                        </div>
                    </div>
                </div>
                <div class="col-md  ">
                    <div class="card bg-light text-dark">
                        <div class="card-body text-center shadow ">
                        <div class="h1 mb-3">
                        <i class="fas fa-money-bill-wave"></i>
                             </div>
                             <h3 class="card-title mb-3">
                                 Funding
                             </h3>
                             <p class="card-text">
                                Up to 200% of your avg <br> monthly earning.
                             </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Lobster&family=Open+Sans&family=Roboto:wght@300&display=swap');
        #section img{
            /* width: 150px; */
            height:400px
        }
        h1{
            font-size:60px;
            font-family: 'Bungee Spice', cursive;
        }
        #section p{
            font-family: 'Bungee Spice', cursive;
        }
        #google img{
            height:58px;
        }
        h3{
            font-family:  Georgia, 'Times New Roman', Times, serif;
            font-weight: bolder; 
        }
        .card p{
            font-size:20px;
            /* font-weight: bold; */
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        .card i{
            color:#FF5500;
        }
    </style>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script>
        let num = "<?php echo $num = "ten"; ?>"
        console.log(num);
    </script>
</body>

</html>