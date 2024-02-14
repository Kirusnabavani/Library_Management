<?php
$servername="localhost";
$username="root";
$password="";
$dbname="library_system"; 

$database = new mysqli($servername, $username, $password, $dbname);

if ($database->connect_error) { 
    die("failiure connection". $database->connect_error);
}
?>