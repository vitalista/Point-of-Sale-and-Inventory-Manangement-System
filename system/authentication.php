<?php
if(!isset($_SESSION['LoggedIn'])){

  header('Location: ../index.php');

}
if (isset($_SESSION['LoggedIn'])) {

  $email = validate($_SESSION['LoggedInUser']['email']);
  $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 0){

    logoutSession();
    // redirect('./index.php', 'Access Denied');
    header('Location: ../index.php');

  }else{

    $row = mysqli_fetch_assoc($result);
    if($row['is_ban'] == 1){
      logoutSession();
      // redirect('./index.php', 'Your Account Is Banned');
      header('Location: ../index.php');
    }

  }

} else {
  // redirect('./index.php', 'Login to Continue');
  header('Location: ../index.php');
}
?>