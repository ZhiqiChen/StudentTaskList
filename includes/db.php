<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "dailyplannerlogin";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName); //connect to server
if (!$conn){ //if didn't connect
  die("Connection failed: ".mysqli_connect_error());

}
