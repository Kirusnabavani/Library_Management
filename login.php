<?php
require_once('config.php');

$error = []; 

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Invalid email format";
    }

    if(empty($error)) {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($database, $query);
        
        if($stmt === false) {
            die("Error preparing statement: " . mysqli_error($database));
        }
        
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])) {
                // Login successful
                // Redirect the user to dashboard.php
                header("Location: dashboard.php");
                exit(); 
            } else {
             
                $error[] = "Invalid password";
            }
        } else {
           
            $error[] = "User not found";
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
    <title>Admin-login form</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Admin Login</h3>
            <?php
            if(!empty($error)){
                foreach($error as $err){
                    echo '<span class="error-msg">'.$err.'</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account? <a href="registration.php">Register now</a></p>
        </form>
    </div>
</body>
</html>
