<?php
$servername="localhost";
$username="root";
$password="";
$dbname="library_system"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { 
    die("failiure connection". $conn->connect_error);
}
?>