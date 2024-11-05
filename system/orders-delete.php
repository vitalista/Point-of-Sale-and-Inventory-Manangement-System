<?php

require 'config/function.php';

$paramResult = checkParamId('id');

if(is_numeric($paramResult)){

$orderId = validate($paramResult);
$order = getById('orders',$orderId);

if($order['status'] == 200){

  $orderDelete = delete('orders',$orderId);
  $orderItemDelete = deleteItem('order_items', $orderId);
  if($orderDelete && $orderItemDelete){

    redirect('orders.php', 'order Deleted Successfully');
    
  }else{
    redirect('orders.php', 'Something Went Wrong');
  } 

}else{
  redirect('orders.php', $order['message']);

}

//echo $orderId;

}else{

  redirect('orders.php', 'Something Went Wrong');

}


?>