<?php
require 'config/function.php';
if($_SESSION['LoggedInUser']['can_delete'] == 1){
$paramResult = checkParamId('id');

if (is_numeric($paramResult)) {

  $categoryId = validate($paramResult);
  $category = getById('categories', $categoryId);

  if ($category['status'] == 200) {

    $adminDelete = delete('categories', $categoryId);
    if ($adminDelete) {

      redirect('categories.php', 'Category Deleted Successfully');
    } else {
      redirect('categories.php', 'Something Went Wrong');
    }
  } else {
    redirect('categories.php', $category['message']);
  }

  //echo $categoryId;

} else {

  redirect('categories.php', 'Something Went Wrong');
}
}else{
  echo '<script>window.location.href = "index.html";</script>';
  }
?>