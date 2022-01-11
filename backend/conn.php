<?php
  $hostname = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "rtcamp_d";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    header("location: /error.php?error=Database Error");
  }
?>