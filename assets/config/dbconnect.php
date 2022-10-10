<?php
// Local
    $server = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "early_money";

// Online
    // $server = "localhost";
    // $dbusername = "u162278070_early";
    // $dbpassword = "0>?y!ZOZn";
    // $dbname = "u162278070_earlymoney";

    
    $connectDB =  mysqli_connect($server,$dbusername,$dbpassword,$dbname);
