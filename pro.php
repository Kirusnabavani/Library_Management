<?php
require_once('./config.php');
session_start();

$update = false;
$fine_id="";
$book_id="";
$member_id="";
$fine_amount="";
$fine_date_modified="";

if (isset($_POST['save'])) {

    print_r($_POST);

    $fine_id = $_POST['fine_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified =date('Y-m-d H:i:s');

    $sql = "INSERT INTO fine(`fine_id`, `book_id`, `member_id`, `fine_amount`, `fine_date_modified`) VALUES ('$fine_id','$book_id','$member_id','$fine_amount','$fine_date_modified')";
    if ($database->query($sql) === TRUE) {
        echo "Fine has been saved!";
        header("Location: fine.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $database->error;
    }

}

if (isset($_GET['delete'])) {


    $fine_id = $_GET['delete'];
    

    $sql = "DELETE FROM fine WHERE $fine_id = fine_id";
    $database->query($sql) or die($database->error);
    echo "<h1>Now you are in the process.php file /$_GET [delete]/<-deleted</h1>";

    header("Location: fine.php");
    exit();

}

if (isset($_GET['edit'])) {
    $fine_id = $_GET['edit'];
    $update = true;

    $result = $database->query("SELECT * FROM fine WHERE fine_id = '$fine_id'");

    if (count(array($result)) == 1) {
        $row = $result->fetch_array() or die($database->error);
        $fine_id = $row["fine_id"];
        $book_id = $row["book_id"];
        $member_id = $row["member_id"];
        $fine_amount = $row["fine_amount"];
        $fine_date_modified = $row["fine_date_modified"];

       

    }
}

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

   
    $sql = "SELECT * FROM fine WHERE fine_id = '$edit_id'";
    $result = $database->query($sql);

    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        $edit_fine_id = $row['fine_id'];
        $edit_book_id = $row['book_id'];
        $edit_member_id = $row['member_id'];
        $edit_fine_amount = $row['fine_amount'];
        $edit_fine_date_modified = $row['fine_date_modified'];
        
    } else {
        
        echo "Error: fine not found or multiple fines found.";
        exit; 
    }
}
if (isset($_POST['update'])) {

    $fine_id = $_POST['fine_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified = date('Y-m-d H:i:s');

    $sql = "UPDATE fine SET `fine_id`='$fine_id',`book_id`='$book_id',`member_id`='$member_id',`fine_amount`='$fine_amount',`fine_date_modified`='$fine_date_modified' WHERE fine_id = '$fine_id'";
    
    $database->query($sql) or die($database->error);

 
    $_SESSION['message'] = "Fine has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("Location: fine.php");
    exit();
}
?>