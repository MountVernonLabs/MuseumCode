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
      $user = json_decode($github_user);
      echo $user->{"id"}."\n";

      $sql = "UPDATE organizations SET id=".$user->{"id"}." WHERE user='".$row["user"]."'";
      if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
      } else {
          echo "Error updating record: " . $conn->error;
      }
  }
}


// Close database connection
$conn->close();
