<?php 

    //DB CREDENTIALS
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $dbname = "products";



    //CONNECTING TO DB
    $con = @mysqli_connect($host, $user, $pass, $dbname);

    if (mysqli_connect_errno()) {
    echo json_encode(["error" => "Network Error!"]);
    exit();
    }


?>