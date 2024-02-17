<?php
feature-book-reg_CT_2019_094
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

// Create connection
$database = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}
?>


=======
$servername="localhost";
$username="root";
$password="";
$dbname="library_system"; 

$database = new mysqli($servername, $username, $password, $dbname);

if ($database->connect_error) { 
    die("failiure connection". $database->connect_error);
}
?>
 Development
