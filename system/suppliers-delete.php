<?php

require 'config/function.php';
if($_SESSION['LoggedInUser']['can_delete'] == 1){
$paramResult = checkParamId('id');
if (is_numeric($paramResult)) {

  $supplierId = validate($paramResult);
  $supplier = getById('suppliers', $supplierId);

  if ($supplier['status'] == 200) {

    $adminDelete = delete('suppliers', $supplierId);
    if ($adminDelete) {

      redirect('suppliers.php', 'Supplier Deleted Successfully');
    } else {
      redirect('suppliers.php', 'Something Went Wrong');
    }
  } else {
    redirect('suppliers.php', $supplier['message']);
  }

  //echo $supplierId;

} else {

  redirect('suppliers.php', 'Something Went Wrong');
}

}else{
  echo '<script>window.location.href = "index.html";</script>';
  }
?>