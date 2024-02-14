<?php
require_once("./config.php");
session_start();

$update = false;
$member_id = "";
$first_name = "";
$last_name = "";
$birthday = "";
$email = "";

if (isset($_POST['save'])) {
    print_r($_POST);
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = date('Y-m-d');
    $email = $_POST['email'];

    // if (!validate_member_id($member_id)) {
    //     $_SESSION['message'] = "Invalid Category ID format. Example: C001";
    //     $_SESSION['msg_type'] = "danger";
    // }
        

    $sql = "INSERT INTO member (member_id, first_name, last_name,birthday,email) VALUES ('$member_id', '$first_name', '$last_name', '$birthday', '$email')";
    if ($database->query($sql) === TRUE) {
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "warning";
        header("Location: member_registration.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $database->error;
    }
}

if (isset($_POST['update'])) {
    $Member_id = $_POST['member_id'];
    $First_name = $_POST['first_name'];
    $Last_name = $_POST['last_name'];
    $Birthday = date('Y-m-d');
    $Email = $_POST['email'];

    $sql = "UPDATE `member` SET `first_name`='$First_name', `last_name`='$Last_name', `birthday`='$Birthday', `email`='$Email' WHERE member_id = '$Member_id'";
    $database->query($sql) or die($database->error);

    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("Location:member_registration.php");
    exit();
}


if (isset($_GET['delete'])) {
    $member_id =  $_GET['delete'];
    $sql = "DELETE FROM member WHERE member_id='$member_id'";
    $database->query($sql) or die($database->error);

    $_SESSION['message'] = "Book category deleted successfully!";
    $_SESSION['msg_type'] = "danger";


    header("Location:member_registration.php");
    exit();

}

if (isset($_GET['edit'])) {
    $member_id = $_GET['edit'];
    $update = true;

    $sql = "SELECT * FROM member WHERE member_id='$member_id'";
    $result = $database->query($sql) or die($database->error);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $member_id = $row['member_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $birthday = $row['birthday'];
        $email = $row['email'];
    }
}
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

    // Fetch the record from the database based on the edit_id
    $sql = "SELECT * FROM member WHERE member_id='$member_id'";
    $result = $database->query($sql) or die($database->error);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $member_id = $row['member_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $birthday = $row['birthday'];
        $email = $row['email'];
    } else {
        // If no or multiple records found, handle the error appropriately
        echo "Error: Record not found or multiple records found.";
        exit; // You might want to handle this better based on your application's flow
    }
}
?>
