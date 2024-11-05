<?php
    @session_start();
require 'connection.php';
include('kick.php');

// Input field validation
function validate($inputData){
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    $data = trim($validatedData);
    return htmlspecialchars($data);
}

// Redirect from one page to another page with a message (Status)
function redirect($url, $status){
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}

// Display messages or status after any process
function alertMessage(){
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"
        style="text-align: center; font-weight: bold;"
        >'.
            $_SESSION['status'] .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}

function top1( $tableName ){
global $conn;
$query = "SELECT product_id, SUM(quantity) AS total_quantity
FROM $tableName
GROUP BY product_id
ORDER BY total_quantity DESC
LIMIT 1";

$result = mysqli_query($conn, $query);
return $result;
}

function top2( $tableName ){
    global $conn;
    $query = "SELECT product_id, SUM(quantity) AS total_quantity
    FROM $tableName
    GROUP BY product_id
    ORDER BY total_quantity DESC
    LIMIT 1, 2";
    
    $result = mysqli_query($conn, $query);
    return $result;
}

function top3(){
    global $conn;
    $query = "SELECT product_id, SUM(quantity) AS total_quantity FROM order_items GROUP BY product_id ORDER BY total_quantity DESC LIMIT 1 OFFSET 2;";
    
    $result = mysqli_query($conn, $query);
    return $result;
}

function getProdName( $id ){
    global $conn;

    $query = "SELECT * from products WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Create/Delete function
function insert($tableName, $data){
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO $table ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update data using this function
function update($tableName, $id, $data){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = '';

    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get all data in table
function getAll($tableName){
    global $conn;

    $table = validate($tableName);
 
        $query = "SELECT * FROM $table";
    
    return mysqli_query($conn, $query);
}

function greeedy($tableName){
    global $conn;

    $table = validate($tableName);
 
        $query = "SELECT * FROM $table WHERE id != 25";
    
    return mysqli_query($conn, $query);
}

// Get all user except ADMIN
function getAllUser($tableName){
    global $conn;

    $table = validate($tableName);

        $query = "SELECT * FROM $table WHERE user_role='USER'";
  
    return mysqli_query($conn, $query);
}

// Get by Data ID specifically for edit button if it exist status=200
function getById($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $response = [
                'status' => 200,
                'data' => $row,          //get data database
                'message' => 'Record Found'
            ];
            return $response;
            
        } else {
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }
}

// Delete data from the database using ID
function delete($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

function deleteItem($tableName, $itemId){
    global $conn;

    $table = validate($tableName);
    $itemId = validate($itemId);

    $query = "DELETE FROM $table WHERE order_id='$itemId'";
    $result = mysqli_query($conn, $query);
    return $result;
}

// custome alert to set in what message you want
function alertCustom($message){

    return '<div class="alert alert-warning alert-dismissible fade show"  role="alert" 
    style="text-align: center; font-weight: bold;"
    >
    '.$message.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>'; 
}

//checks param or in the url 
function checkParamId($type){
    if(isset($_GET[$type])){

        if($_GET[$type] != ''){

            return $_GET[$type];

        }else{
            return '<h4>No ID Found </h4>'; 
        }

    }else{
        return '<h4>No ID Given </h4>';
    }
}

//removing user session data 
function logoutSession(){

    unset($_SESSION['LoggedIn']);
    unset($_SESSION['LoggedInUser']);

}


function addminId($id){

    global $conn;

    $table = 'users';
    $role = 'ADMIN';

    $query = "SELECT * FROM $table WHERE user_role='$role' AND id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $res = ['data' => $row];

            return $res['data']['id'];
        }else{
       return '';
        }

    }else{
        return '';
    }
}

function getCategoryName($productId){

    global $conn;
    $table = 'categories';
    $query = "SELECT * FROM $table WHERE id='$productId' LIMIT 1";
    $result = mysqli_query($conn, $query);
 
    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $res = ['data' => $row];

            return $res['data']['name'];
        }else{
       return '';
        }

    }else{
        return '';

    }

}


function jsonResponse($status, $status_type,  $message){

    
    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
      ];
  
      echo json_encode($response);
      return;

}

//multi getcount dashboard
function getCount($tableName, $user_role, $confirm){
    global $conn;
    $table = validate($tableName);
    $user_role = validate($user_role);
    $confirm = validate($confirm);

    if(empty($user_role) && empty($confirm)){
        $query = "SELECT * FROM $table";
    }else if(empty($confirm)){
        $query = "SELECT * FROM $table WHERE user_role='$user_role'";        
    }else{
      if($confirm == 1){
        $query = "SELECT * FROM $table WHERE confirmation='$confirm'";  //1
        }else{
        $query = "SELECT * FROM $table WHERE confirmation != '$confirm'";
     }
    }
    $query_run = mysqli_query($conn, $query);
    if($query_run){

        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    }else{
        return 'Something Went Wrong';
    }
}


// Get Out of stock products
function getCountProd($tableName, $outof){
    global $conn;
    $table = validate($tableName);

        $query = "SELECT * FROM $table WHERE quantity < $outof";        

    $query_run = mysqli_query($conn, $query);


    if($query_run){

        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    }else{
        return 'Something Went Wrong';
    }
}

function getProdCode($tableName, $id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

        $query = "SELECT * FROM $table WHERE id=$id LIMIT 1";        

    $query_run = mysqli_query($conn, $query);


    if($query_run){

       $row = mysqli_fetch_assoc($query_run);

        return $row['product_code'];
    }else{
        return 'No Item Found';
    }
}


?>
