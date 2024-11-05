<?php

include('config/function.php');

if (!isset($_SESSION['Items'])) {

  $_SESSION['Items'] = [];
}

if (!isset($_SESSION['ItemIds'])) {

  $_SESSION['ItemIds'] = [];
}

if (isset($_POST['addOrder'])) {
  $productId = validate($_POST['product_id']);
  $quantity = validate($_POST['quantity']);

  $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
  if ($checkProduct) {
    if (mysqli_num_rows($checkProduct) > 0) {

      $row = mysqli_fetch_assoc($checkProduct);


        $productData = [

          'product_code' => $row['product_code'],

          'product_id' =>  $row['id'],
          'name'       =>  $row['name'],
          'image'       =>  $row['image'],
          'price'       =>  $row['price'],
          'quantity'       =>  $quantity
        ];

        if (!in_array($row['id'], $_SESSION['ItemIds'])) {

          array_push($_SESSION['ItemIds'], $row['id']);
          array_push($_SESSION['Items'], $productData);
        } else {

          foreach ($_SESSION['Items'] as $key => $prodSessItem) {

            if ($prodSessItem['product_id'] == $row['id']) {

              $newQuantity = $prodSessItem['quantity'] + $quantity;

              $productData = [

                'product_code' => $row['product_code'],

                'product_id' =>  $row['id'],
                'name'       =>  $row['name'],
                'image'       =>  $row['image'],
                'price'       =>  $row['price'],
                'quantity'       =>  $newQuantity
              ];

              $_SESSION['Items'][$key] =  $productData;
            }
          }
        }


        redirect('purchase-order-create.php', 'Item added ' . $row['name']);
      }
    } else {
      redirect('purchase-order-create.php', 'No Product Found');
    }
}

if(isset($_POST['saveOrder']) && !isset($_POST['addOrder'])){

    if(!isset($_POST['supplier_id']) && !isset($_POST['payment_mode'])){
      redirect('purchase-order-create.php', 'Select Supplier and Select Payment');
      exit;
    }

    $id = validate($_POST['supplier_id']); 
    $payment_mode = validate($_POST['payment_mode']);
    $total = validate($_POST['total_amount']);

    if (!isset($_POST['payment_mode'])) {

      // header("Location: {$_SERVER['HTTP_REFERER']}");
      redirect('purchase-order-create.php', 'Select Payment');
      exit;
    }elseif(!isset($_POST['supplier_id'])){
      // echo '<script>window.history.back();</script>';
      redirect('purchase-order-create.php', 'Select Supplier');
      exit;
}
    
    


  $order_placed_by_id = $_SESSION['LoggedInUser']['user_id'];

  if($id != '' && $payment_mode != ''){

  if($payment_mode == 'Cash Payment' || $payment_mode == 'Online Payment'){
    
    // ifif
    
    $checkSupp = mysqli_query($conn, "SELECT * FROM suppliers WHERE id='$id' LIMIT 1");

    if(!$checkSupp){
      redirect('purchase-order-create.php', 'no supp query');
    }

    if(mysqli_num_rows($checkSupp) > 0){
      $suppData = mysqli_fetch_assoc($checkSupp);

      if(!isset($_SESSION['Items'])){
        redirect('purchase-order-create.php', 'no items in sess');

      }

      $sessionProducts = $_SESSION['Items'];


      foreach($sessionProducts as $amtItem){

  

      }

     $currentdate = date('y-m-d');
     $checkDateSupp = mysqli_query($conn, "SELECT * FROM purchase_orders WHERE purchase_order_date='$currentdate' AND supplier_id=$id AND confirmation!=1 LIMIT 1");

     if(mysqli_num_rows($checkDateSupp) == 0){

      $data = [
        'supplier_id' => $suppData['id'],
        'tracking_no' => rand(11111, 99999),
        'total_amount' => $total,
        'purchase_order_date' => date('y-m-d'),
        'orders_status' => 'placed',
        'payment_mode' => $payment_mode,
        'order_placed_by_id' => $order_placed_by_id
      ];

      $result = insert('purchase_orders', $data);
      
      $lastOrderId = mysqli_insert_id($conn);

      foreach($sessionProducts as $prodItem){

        $productId = $prodItem['product_id'];
        $price = $prodItem['price'];
        $quantity = $prodItem['quantity'];

        //insert order items
        $dataOrderItem = [

          'order_id' => $lastOrderId,
          'product_id' => $productId,
          'price' => $price,
          'quantity' => $quantity,

        ];
        $oderItemQuery = insert('purchase_order_items', $dataOrderItem);


      }

      unset($_SESSION['Items']);
      unset($_SESSION['ItemIds']);

      redirect('purchase-order-create.php', 'Order placed successfully');

     }else{

      $getPoId = mysqli_fetch_assoc($checkDateSupp);
      $getedPoId = $getPoId['id'];
  
      foreach ($sessionProducts as $prodItem) {

    $productId = $prodItem['product_id'];
    $price = $prodItem['price'];
    $quantity = $prodItem['quantity'];

    // Check if a record already exists for the current product ID
    $checkProdtoUpdateQuant = mysqli_query($conn, "SELECT * FROM purchase_order_items WHERE product_id='$productId'");
    
    if (mysqli_num_rows($checkProdtoUpdateQuant) == 0) {
        // If no record exists, insert a new record
        $dataOrderItem = [
            'order_id' => $getedPoId,
            'product_id' => $productId,
            'price' => $price,
            'quantity' => $quantity,
        ];
        $oderItemQuery = insert('purchase_order_items', $dataOrderItem);
    } else {
        // If a record exists, update the existing record
        $catchId = mysqli_fetch_assoc($checkProdtoUpdateQuant);
        $poiId = $catchId['id'];
        $poiQuant = $catchId['quantity'];
        $dataOrderItem = [
            'order_id' => $getedPoId,
            'product_id' => $productId,
            'price' => $price,
            'quantity' => $quantity + $poiQuant,
        ];
        update('purchase_order_items', $poiId, $dataOrderItem);
    }
}

  
      unset($_SESSION['Items']);
      unset($_SESSION['ItemIds']);
  
      redirect('purchase-order-create.php', 'Order updated successfully');
  
    }
    
    }else{

      // redirect('purchase-order-create.php', 'No supplier found');
      alertCustom('No supplier found');
    }

  }else{
    // redirect('purchase-order-create.php', 'Please Select Payment Mode');
    alertCustom('Please Select Payment Mode');
  }
  }

}else{
  redirect('purchase-order-create.php', 'No Item Added'); 
  // isset

}

?>