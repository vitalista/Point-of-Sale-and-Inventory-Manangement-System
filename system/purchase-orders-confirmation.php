<?php

require 'config/function.php';

$paramResult = checkParamId('id');
if($paramResult && is_numeric($paramResult)){
  $checkDElivery = mysqli_query($conn, "SELECT confirmation FROM purchase_orders WHERE id='$paramResult'");

  $row = mysqli_fetch_assoc($checkDElivery);

  if($checkDElivery && $row['confirmation'] == 0){

      $sql = "SELECT poi.quantity AS poiItemQuantity, p.quantity AS pQuantity, p.id AS prodId
      FROM purchase_order_items AS poi
      JOIN products AS p ON p.id = poi.product_id
      WHERE poi.order_id = '$paramResult'";
      
      $result = mysqli_query($conn, $sql);
  
      if(mysqli_num_rows($result) > 0) {
          while ($data = mysqli_fetch_assoc($result)) {
      
              $id = $data['prodId'];
              echo '<h1>' . $data['poiItemQuantity'] . '</h1>';
              echo '<h2>' . $data['pQuantity'] . '</h2>';
              $newQuantity = $data['pQuantity'] + $data['poiItemQuantity'];
      
              $fetch = [
                'quantity' => $newQuantity
              ];
      
              update('products', $id, $fetch);
              
      
          }

          $confirmation = [
            'confirmation' => 1
          ];

          $confirmed = update('purchase_orders', $paramResult, $confirmation);
          if($confirmed){
            redirect('purchase-orders.php', 'Delivery Recieved and Quantity Updated');
          }else{
            redirect('purchase-orders.php', 'Something Went Wrong');
          }
      
      }
        else{
          echo '<h1>Wrong query</h1>';
        }
  } else{

    redirect('purchase-orders.php', 'Purchase Orders Already Received');

  }
  

}else{

  redirect('purchase-orders.php', 'Invalid Confirmatiom');

}



