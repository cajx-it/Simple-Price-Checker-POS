<?php 
    
    $request = json_decode(file_get_contents('php://input'), true);
    $password = "admin";
    $user_name = "admin";

    if($request['username'] == $user_name && $request['pass'] == $user_name){
        session_start();
        $_SESSION['login'] = true;
        echo json_encode("Success");
    }else{
        echo json_encode("Error");
    }



?>