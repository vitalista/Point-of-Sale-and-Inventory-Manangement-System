<?php

require 'config/function.php';
if($_SESSION['LoggedInUser']['can_delete'] == 1){
$paramResult = checkParamId('id');

if (is_numeric($paramResult)) {

  $productId = validate($paramResult);
  $product = getById('products', $productId);

  if ($product['status'] == 200) {

    $productDelete = delete('products', $productId);
    if ($productDelete) {
      $deleteImage = "./".$product['data']['image'];

      if(file_exists($deleteImage)){
        unlink($deleteImage);
      }

      redirect('products.php', 'Product Deleted Successfully');
    } else {
      redirect('products.php', 'Something Went Wrong');
    }
  } else {
    redirect('products.php', $product['message']);
  }

  //echo $productId;

} else {

  redirect('products.php', 'Something Went Wrong');
}
}else{
  echo '<script>window.location.href = "index.html";</script>';
  }
?>