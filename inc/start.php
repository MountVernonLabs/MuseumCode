<?php
  // Load database config
  include "config.inc";
  include "inc/functions.php";

  // Make database connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>
