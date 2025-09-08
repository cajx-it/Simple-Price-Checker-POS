<?php 

    include("my_sql_db\db.php");

    //DECODE INCOMING JSON
    $barcode = $_POST['value'];
    $query = "SELECT * FROM products_info WHERE BARCODE = '$barcode'";

    //QUERY TO DB
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);

    //DISPLAY THE RESULT
    if (is_array($row)) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No product found."]);
    }

    //CLOSE THE CONNECTION
    mysqli_close($con); 

?>