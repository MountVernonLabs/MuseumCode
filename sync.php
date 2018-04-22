<?php
// Load database config
include "config.inc";

// Make database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all organizations and update their latest information
$sql = "SELECT user FROM organizations order by rand() limit 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Looking at ".$row["user"]."\n";

      // Get user profile from GitHub and update database entry
      $github_user = file_get_contents("http://api.github.com/users/".$row["user"], true, $context);
      $user = json_decode($github_user);

      $sql = "UPDATE organizations SET id=".$user->{"id"}." WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET name='".$user->{"name"}."' WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET avatar='".$user->{"avatar_url"}."' WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET email='".$user->{"email"}."' WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET location='".$user->{"location"}."' WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET bio='".addslashes($user->{"bio"})."' WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET repos=".$user->{"public_repos"}." WHERE user='".$row["user"]."';";
      $conn->query($sql);

      $sql = "UPDATE organizations SET url='".$user->{"blog"}."' WHERE user='".$row["user"]."';";
      $conn->query($sql);
      sleep(10);

      // Get a list of repos for the organization
      $github_repos = file_get_contents("http://api.github.com/users/".$row["user"]."/repos?per_page=100", true, $context);
      $repos = json_decode($github_repos);

      foreach ($repos as $repo){
        echo "Found ".$repo->{'name'}."\n";

        $sql = "INSERT INTO repos SET id=".$repo->{'id'}.",org=".$user->{"id"}.",name='".$repo->{'name'}."',description='".addslashes($repo->{'description'})."',url='".$repo->{'html_url'}."',created='".$repo->{'created_at'}."',updated='".$repo->{'updated_at'}."',language='".$repo->{'language'}."' ON DUPLICATE KEY UPDATE name='".$repo->{'name'}."',description='".addslashes($repo->{'description'})."',url='".$repo->{'html_url'}."',created='".$repo->{'created_at'}."',updated='".$repo->{'updated_at'}."',language='".$repo->{'language'}."';";
        $conn->query($sql);

      }
      if ($user->{"public_repos"} > 100){
        $github_repos = file_get_contents("http://api.github.com/users/".$row["user"]."/repos?per_page=100&page=2", true, $context);
        $repos = json_decode($github_repos);

        foreach ($repos as $repo){
          echo "Found ".$repo->{'name'}."\n";

          $sql = "INSERT INTO repos SET id=".$repo->{'id'}.",name='".$repo->{'name'}."',description='".addslashes($repo->{'description'})."',url='".$repo->{'html_url'}."',created='".$repo->{'created_at'}."',updated='".$repo->{'updated_at'}."',language='".$repo->{'language'}."' ON DUPLICATE KEY UPDATE name='".$repo->{'name'}."',description='".addslashes($repo->{'description'})."',url='".$repo->{'html_url'}."',created='".$repo->{'created_at'}."',org=".$user->{"id"}.",updated='".$repo->{'updated_at'}."',language='".$repo->{'language'}."';";
          $conn->query($sql);

        }
      }
      echo "\n\n";
      sleep(10);
  }
}


// Close database connection
$conn->close();
