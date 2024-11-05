<script src="otp/script.js"></script>

<body style="
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url('system/images/loginbackground.jpg');">
</body>
<?php
require 'system/config/function.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  if (empty($email) && empty($password)) {
    echo '<script> alert("Empty Fields!"); window.location.href = "index.php"; </script>';
  }

  $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo '<script> alert("Invalid Email Address!"); window.location.href = "index.php"; </script>';
  }

  if (mysqli_num_rows($result) != 1) {
    echo '<script> alert("Invalid Email Address!"); window.location.href = "index.php"; </script>';
  }

  $row = mysqli_fetch_assoc($result);
  $hashedPassword = $row['password'];

  if (!password_verify($password, $hashedPassword)) {
    echo '<script> alert("Invalid Username or Password!"); window.location.href = "index.php"; </script>';
  }

  $_SESSION['LoggedIn'] = true;
  $_SESSION['LoggedInUser'] = [

    'user_id' => $row['id'],
    'name' => $row['name'],
    'email' => $row['email'],
    'phone' => $row['phone'],
    'user_role' => $row['user_role'],

    'can_create' => $row['can_create'],
    'can_edit' => $row['can_edit'],
    'can_delete' => $row['can_delete'],

  ];

  if ($row['is_ban'] == 1) {
    echo '<script> alert("Your Account Has Been Banned, Please Contact Your Admin"); window.location.href = "index.php"; </script>';
  }

?>
  <script>
    window.location.href = "system/homepage.php";
  </script>
<?php


} else {
  echo '<script> alert("Something Went Wrong!"); window.location.href = "index.php"; </script>';
}


?>