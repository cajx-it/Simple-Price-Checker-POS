<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: ../login/index.php');
        exit();
    }
    include('../my_sql_db/db.php');

    $code = $_POST['Code'];
    $name = $_POST['Name'];
    $price = $_POST['Price'];
    $orgName = $_POST['Orgname'];
    $upOk = true;

    //IF THE NAME IS NOT THE SAME AND FILE IS EMPTY, RENAME THE OLD FILE
    if(!($orgName == $name) && empty($_FILES['Img'])){
        $fileF = "../img/" . $orgName . ".jpg";
        $fileT = "../img/" . $name . ".jpg";
        if(!rename($fileF, $fileT)){
            echo json_encode(["status" => "error"]);
            $upOk = false;
        }
        $upOk = true;
        //IF NAME IS NOT THE SAME AND FILE IS NOT EMPTY, REMOVE THE OLD FILE AND UPLOAD THE NEW FILE WITH THE UPDATED NAME
    }else if(!($orgName == $name) && !empty($_FILES['Img'])){

        $imageFileType = strtolower(pathinfo(basename($_FILES["Img"]["name"]),PATHINFO_EXTENSION));
        if($imageFileType == "jpg"){

            if ($_FILES['Img']["size"] < 200000) {

                // DELETE THE OLD FILE
                $fileD = "../img/" . $orgName . ".jpg";
                unlink($fileD);
                //NEW FILE 
                $path = "../img/" . $name . ".jpg";

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
    // IF NAME IS THE SAME AND FILE IS NOT EMPTY DELETE THE OLD FILE WITH THE SAME NAME
    }else if ($orgName == $name && !empty($_FILES['Img'])){

        $imageFileType = strtolower(pathinfo(basename($_FILES["Img"]["name"]),PATHINFO_EXTENSION));
        if($imageFileType == "jpg"){

            if ($_FILES['Img']["size"] < 200000) {

                // DELETE THE OLD FILE
                $fileD = "../img/" . $orgName . ".jpg";
                unlink($fileD);
                //NEW FILE 
                $path = "../img/" . $orgName . ".jpg";

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
        $query = "UPDATE `products_info` 
                SET `BARCODE`='$code',
                    `PRODUCT_NAME`='$name',
                    `PRICE`='$price' 
                WHERE `PRODUCT_NAME`='$orgName'";

        $result = mysqli_query($con, $query);

        if (!$result) {
            die('Invalid query: ' . mysqli_error($con));
        }
        $_POST['status'] = true;
    }
    echo json_encode($_POST);
?>