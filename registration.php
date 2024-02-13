<?php
require_once('config.php');

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password length
function validatePassword($password) {
    return strlen($password) >= 8;
}

// Function to validate user ID format
function validateUserID($userID) {
    return preg_match('/^U\d{3}$/', $userID); // Matches U followed by exactly 3 digits
}

// Check if form is submitted
if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $userid = $_POST['user_id'];
    $ps = $_POST['password'];

    // Validate email format
    if (!validateEmail($email)) {
        $error[] = "Invalid email format";
    }

    // Check if username already exists
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $database->query($query);
    if ($result->num_rows > 0) {
        $error[] = "Username already exists";
    }

    // Check if email already exists
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $database->query($query);
    if ($result->num_rows > 0) {
        $error[] = "Email already exists";
    }

    // Validate password length
    if (!validatePassword($ps)) {
        $error[] = "Password must be at least 8 characters long";
    }

    // Validate user ID format
    if (!validateUserID($userid)) {
        $error[] = "User ID must be in the format U001";
    }

    // If there are no errors, proceed with insertion
    if (!isset($error)) {
        // Hash the password using a secure hashing algorithm (e.g., bcrypt)
        $hashed_password = password_hash($ps, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO user (user_id, email, first_name, last_name, username, password) VALUES ('$userid', '$email', '$fname','$lname','$username','$hashed_password')";
        $database->query($sql) or die($database->error);
        echo "Record has been saved!";
    } else {
        // If there are errors, display them
        foreach ($error as $error_msg) {
            echo '<span class="error-msg">' . $error_msg . '</span>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="user_id" required placeholder="enter your id" pattern="U\d{3}" title="User ID must be in the format U001">
      <input type="text" name="fname" required placeholder="enter your first-name">
      <input type="text" name="lname" required placeholder="enter your last-name">
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>
