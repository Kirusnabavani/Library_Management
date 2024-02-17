<?php
require_once('config.php');

session_start(); 

$error = []; 

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if(empty($username) || empty($password)) {
        $error[] = "Username and password are required";
    } else {
        
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = mysqli_prepare($database, $query);
        
        
        if($stmt === false) {
            die("Error preparing statement: " . mysqli_error($database));
        }
        
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])) {
                // Login successful
                $_SESSION['user_id'] = $row['id'];
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
    <title>Login</title>
   
    <link rel="stylesheet" href="style56.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login</h3>
            <?php
            if(!empty($error)){
                foreach($error as $err){
                    echo '<span class="error-msg">'.$err.'</span>';
                }
            }
            ?>
           
           
            <input type="text" name="username" required placeholder="Enter your username">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account?  <a href="registration.php" style="color: red;">Register now</a></p>
        </form>
    </div>
</body>
</html>
