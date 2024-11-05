<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +1);

if($page == 'code.php'){
echo '<script>window.location.href = "index.html"; </script>';
}

if($page == 'connection.php'){
  echo '<script>window.location.href = "index.html"; </script>';
}

if($page == 'function.php'){
  echo '<script>window.location.href = "index.html"; </script>';
}

if($page == 'kick.php'){
  echo '<script>window.location.href = "index.html"; </script>';
}
?>