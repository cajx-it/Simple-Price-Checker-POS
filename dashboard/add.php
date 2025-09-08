<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: ../login/index.php');
        exit();
    }


    include('../my_sql_db/db.php');
    $code  = $_POST['Code'] ?? '';
    $name  = $_POST['Name'] ?? '';
    $price = $_POST['Price']?? '';
    $upOk = false;
    $path = "../img/";
    $newname =  $name . ".jpg";
    $path = $path . $newname;

    if(!empty($_FILES['Img']))
    {
        $imageFileType = strtolower(pathinfo(basename($_FILES["Img"]["name"]),PATHINFO_EXTENSION));

        if($imageFileType == "jpg"){

            if ($_FILES['Img']["size"] < 200000) {

                if(move_uploaded_file($_FILES['Img']['tmp_name'], $path)) {
                    $_POST['status'] = true;
                    $upOk = true;
                } else{
                    $_POST['status'] = false;
                    $_POST['errcode'] = "Upload Failed";
                    $upOk = false;
                }
                
            }else{
                $_POST['status'] = false;
                $_POST['errcode'] = "File is too large";
                $upOk = false;
            }
        }else{
            $_POST['status'] = false;
            $_POST['errcode'] = "Sorry, only JPG format is allowed.";
            $upOk = false;
        }
    }

    if ($upOk){
        $query = "INSERT INTO products_info VALUES ('$code', '$name', '$price')";
        
        $result = mysqli_query($con, $query);

        if (!$result) {
            die('Invalid query: ' . mysqli_error($con));
        }
    }
    
    echo json_encode($_POST);


?>
