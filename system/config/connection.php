<?php
include ('kick.php');
define('server', "localhost");
define('username', "root");
define('password', "");
define('database', "mnj");

try {
  $conn = mysqli_connect(server, username, password, database);
} catch (Exception $e) {
}

?>
