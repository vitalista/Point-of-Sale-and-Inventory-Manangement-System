<?php
if (file_exists('config/function.php') && file_exists('authentication.php')) {
  require 'config/function.php';
  require 'authentication.php';

  function hasInternet()
  {
    // $headers = @get_headers('https://www.google.com');
    // return $headers !== false && strpos($headers[0], '200 OK') !== false;

    return false;
  }
} else {
  header('Location: index.html');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <title>POS and Inventory Management</title>
  <script src="js/icon.js"></script>
  <script>
    setTabIcon('MJ');
  </script>

  <?php if (hasInternet()) {?>

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a2ecc89c01.js" crossorigin="anonymous"></script>

    <!-- select2 cdn -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- alertify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />


  <?php } else { ?>
    <link rel="stylesheet" href="local-cdn/lineicons.css">
    <link rel="stylesheet" href="local-cdn/bootstrap.min.css">
    <link href="local-cdn/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="local-cdn/alertify.min.css" />
    <link rel="stylesheet" href="local-cdn/default.min.css" />
  <?php } ?>

  <link rel="stylesheet" href="css/homepage.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- <script type="text/javascript" src="../local-cdn/loader.js"></script> -->
</head>

<div class="wrapper">

  <body>
    <?php include("sidebar.php"); ?>
    <div>
      <?php include('includes/head.php'); ?>
    </div>
   