<?php
require_once('./config.php');
session_start();

$update = false;
$BorrowID="";
$BookID="";
$MemberID="";
$B_Status="";
$Date_Modified="";

if (isset($_POST['Add borrow'])) {

    print_r($_POST);

    $BorrowID = $_POST['borrow_id'];
    $BookID = $_POST['book_id'];
    $MemberID = $_POST['member_id'];
    $B_Status = $_POST['borrow_status'];
    $Date_Modified = $_POST['borrower_date_modified'];
    

    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) 
        VALUES ('$BorrowID', '$BookID', '$MemberID', '$B_Status', '$Date_Modified')";

    $database->query($sql) or die($database->error);
    echo "Record has been saved!";
    echo "Now you are in the process.php file $_POST ['Add borrow']";

    header("Location: book_borrow.php");
}

if (isset($_GET['delete'])) {

    $BorrowID = $_GET['delete'];
    
    $sql = "DELETE FROM bookborrower WHERE borrow_id = '$BorrowID'";

    $database->query($sql) or die($database->error);
    echo "<h1>Now you are in the process.php file /$_GET [delete]/<-deleted</h1>";

    header("Location: book_borrow.php");
}

if (isset($_GET['edit'])) {
    $BorrowID = $_GET['edit'];
    $update = true;

    $result = $database->query("SELECT * FROM bookborrower WHERE borrow_id = '$BorrowID'") or die($database->error);

    if (count(array($result)) == 1) {
        $row = $result->fetch_array() or die($database->error);
        $BorrowID = $row["borrow_id"];
        $BookID = $row["book_id"];
        $MemberID = $row["member_id"];
        $B_Status = $row["borrow_status"];
        $Date_Modified = $row["borrower_date_modified"];

       

    }
}
?>

