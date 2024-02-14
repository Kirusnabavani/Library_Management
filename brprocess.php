<?php
require_once("./config.php");
session_start();

$update = false;
$book_id = "";
$book_name = "";
$category_id = "";


if (isset($_POST['save'])) {
    print_r($_POST);
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_id = $_POST['category_id'];
   

    $sql = "INSERT INTO book (book_id,book_name,category_id) VALUES ('$book_id','$book_name', '$category_id')";
    if ($database->query($sql) === TRUE) {
        echo "Record has been saved!";
        header("Location: book_registration.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $database->error;
    }
}

if (isset($_POST['update'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_id = $_POST['category_id'];
    

    $sql = "UPDATE `book` SET `book_name`='$book_name', `category_id`='$category_id'  WHERE book_id = '$book_id'";
    $database->query($sql) or die($database->error);

    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("Location:book_registration.php");
    exit();
}


if (isset($_GET['delete'])) {
    $book_id = $_GET['delete'];

    // Check if there are any dependent records in bookborrower table
    $check_dependent_sql = "SELECT * FROM bookborrower WHERE book_id = '$book_id'";
    $result = $database->query($check_dependent_sql);

    if ($result->num_rows > 0) {
        // If there are dependent records, show an error message
        $_SESSION['message'] = "Cannot delete the record. Dependent records exist.";
        $_SESSION['msg_type'] = "danger";
    } else {
        // If there are no dependent records, proceed with deletion
        $sql = "DELETE FROM book WHERE book_id='$book_id'";
        $database->query($sql) or die($database->error);
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "warning";
    }

    header("Location: book_registration.php");
    exit();
}


if (isset($_GET['edit'])) {
    $book_id = $_GET['edit'];
    $update = true;

    $sql = "SELECT * FROM book WHERE book_id='$book_id'";
    $result = $database->query($sql) or die($database->error);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $book_id = $row['book_id'];
        $book_name = $row['book_name'];
        $category_id = $row['category_id'];
       
    }
}
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

    // Fetch the record from the database based on the edit_id
    $sql = "SELECT * FROM book WHERE book_id='$book_id'";
    $result = $database->query($sql) or die($database->error);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $book_id = $row['book_id'];
        $book_name = $row['book_name'];
        $category_id = $row['category_id'];
       
    } else {
        // If no or multiple records found, handle the error appropriately
        echo "Error: Record not found or multiple records found.";
        exit; // You might want to handle this better based on your application's flow
    }
}
?>
