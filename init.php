<?php
$servername = "localhost";
$username = "Lyndon";
$password = "09567001280";
$dbname = "iacademy";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>