<?php
require 'config/function.php';
if($_SESSION['LoggedInUser']['user_role'] == 'ADMIN'){
    $paramResult = checkParamId('id');

    if(is_numeric($paramResult)){

    $adminId = validate($paramResult);
    $admin = getById('users',$adminId);

    if($admin['status'] == 200){

      $adminDelete = delete('users',$adminId);
      if($adminDelete){

        redirect('users.php', 'User Deleted Successfully');
        
      }else{
        redirect('users.php', 'Something Went Wrong');
      }

    }else{
      redirect('users.php', $admin['message']);

    }

    //echo $adminId;

    }else{

      redirect('users.php', 'Something Went Wrong');

    }
}else{
  echo '<script>window.location.href = "index.html";</script>';
}
?>