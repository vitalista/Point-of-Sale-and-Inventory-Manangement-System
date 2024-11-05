<?php
require 'config/function.php';
if($_SESSION['LoggedInUser']['can_delete'] == 1){
$paramResult = checkParamId('id');

if (is_numeric($paramResult)) {

  $customerId = validate($paramResult);
  $customer = getById('customers', $customerId);

  if ($customer['status'] == 200) {

    $adminDelete = delete('customers', $customerId);
    if ($adminDelete) {

      redirect('customers.php', 'Customer Deleted Successfully');
    } else {
      redirect('customers.php', 'Something Went Wrong');
    }
  } else {
    redirect('customers.php', $customer['message']);
  }

  //echo $customerId;

} else {

  redirect('customers.php', 'Something Went Wrong');
}
}else{
  echo '<script>window.location.href = "index.html";</script>';
  }
?>