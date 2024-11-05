<?php

require 'config/function.php';

$paramResult = checkParamId('id');

if(is_numeric($paramResult)){

$orderId = validate($paramResult);
$order = getById('purchase_orders',$orderId);

if($order['status'] == 200){

  $orderDelete = delete('purchase_orders',$orderId);
  $orderItemDelete = deleteItem('purchase_order_items', $orderId);
  if($orderDelete && $orderItemDelete){

    redirect('purchase-orders.php', 'order Deleted Successfully');
    
  }else{
    redirect('purchase-orders.php', 'Something Went Wrong');
  } 

}else{
  redirect('purchase-orders.php', $order['message']);

}

//echo $orderId;

}else{

  redirect('purchase-orders.php', 'Something Went Wrong');

}


?>