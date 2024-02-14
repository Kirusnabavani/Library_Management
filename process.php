<?php
require_once('./config.php');
session_start();

$update = false;
$BorrowID="";
$BookID="";
$MemberID="";
$B_Status="";
$Date_Modified="";

if (isset($_POST['Add_borrow'])) {

    print_r($_POST);

    $BorrowID = $_POST['borrow_id'];
    $BookID = $_POST['book_id'];
    $MemberID = $_POST['member_id'];
    $B_Status = $_POST['borrow_status'];
    $Date_Modified = date('Y-m-d H:i:s');
    
    
    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) 
        VALUES ('$BorrowID', '$BookID', '$MemberID', '$B_Status', '$Date_Modified')";

    if ($database->query($sql) === TRUE) {
        echo "Record has been saved!";
        header("Location: book_borrow.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $database->error;
    }
}

if (isset($_GET['delete'])) {

    $BorrowID = $_GET['delete'];
    
    $sql = "DELETE FROM bookborrower WHERE borrow_id = '$BorrowID'";

    $database->query($sql) or die($database->error);
    echo "<h1>Now you are in the process.php file /$_GET [delete]/<-deleted</h1>";

    header("Location: book_borrow.php");
    exit();
}

if (isset($_GET['edit'])) {
    $BorrowID = $_GET['edit'];
    $update = true;

    $result = $database->query("SELECT * FROM bookborrower WHERE borrow_id = '$BorrowID'");

    if (count(array($result)) == 1) {
        $row = $result->fetch_array() or die($database->error);
        $BorrowID = $row["borrow_id"];
        $BookID = $row["book_id"];
        $MemberID = $row["member_id"];
        $B_Status = $row["borrow_status"];
        $Date_Modified = $row["borrower_date_modified"];

       

    }
}


if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

   
    $sql = "SELECT * FROM bookborrower WHERE borrow_id = '$edit_id'";
    $result = $database->query($sql);

    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        $edit_borrow_id = $row['borrow_id'];
        $edit_book_id = $row['book_id'];
        $edit_member_id = $row['member_id'];
        $edit_borrow_status = $row['borrow_status'];
        
    } else {
        
        echo "Error: Record not found or multiple records found.";
        exit; 
    }
}

if (isset($_POST['update'])) {

    $BorrowID = $_POST['borrow_id'];
    $BookID = $_POST['book_id'];
    $MemberID = $_POST['member_id'];
    $B_Status = $_POST['borrow_status'];
    $Date_Modified = date('Y-m-d H:i:s');

    $sql = "UPDATE `bookborrower` SET `borrow_id`='$BorrowID',`book_id`='$BookID',`member_id`='$MemberID',`borrow_status`='$B_Status',`borrower_date_modified`='$Date_Modified' WHERE borrow_id = '$BorrowID'";
    
    $database->query($sql) or die($database->error);

 
    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("Location: book_borrow.php");
    exit();
}
?>

