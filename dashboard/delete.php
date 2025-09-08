<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: ../login/index.php');
        exit();
    }

    include('../my_sql_db/db.php');
    $request = json_decode(file_get_contents('php://input'), true);
    $code = $request['del'];
    $query = "DELETE FROM `products_info` WHERE PRODUCT_NAME = '$code'";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
    // DELETE THE OLD FILE
    $fileD = "../img/" . $code . ".jpg";
    unlink($fileD);
    echo json_encode(["status" => true]);
    mysqli_close($con);
?>