<?php 

  include("../my_sql_db/db.php");

  $request = json_decode(file_get_contents('php://input'), true);
  $command = $request['command'];
  $offset = $request['offset'];
  $limit = 5;

  if ($command){

    
    $query = "SELECT * FROM products_info LIMIT $limit OFFSET $offset";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    
    $offsetN = $offset + $limit;
    $queryN = "SELECT * FROM products_info LIMIT $limit OFFSET $offsetN";
    $resultN = mysqli_query($con, $queryN);
    $rowsN = mysqli_fetch_all($resultN, MYSQLI_ASSOC);

    if (count($rowsN) > 0){
        $status = true;
    }else{
        $status = false;
    }

    $response = [
        'status' => $status,
        'index' => $offset,
        'data' => $rows
    ];

    //DISPLAY THE RESULT
    if (is_array($rows)) {
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "No product found."]);
    }

    //CLOSE THE CONNECTION
    mysqli_close($con); 
}

?>