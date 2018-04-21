<?php
// Load database config
include "config.inc";

// Make database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all organizations and update their latest information
$sql = "SELECT user FROM organizations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo $row["user"]."\n";

      // Get user profile from GitHub
      $github_user = file_get_contents("http://api.github.com/users/".$row["user"], true, $context);
      echo $user->{"id"}."\n";

  }
}


// Close database connection
$conn->close();
