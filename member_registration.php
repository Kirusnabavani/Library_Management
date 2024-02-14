<?php 
require_once("mem_process.php");
require_once("./config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Member Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="mem_style.css">
    <style>
        .center-title {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            background-color:palevioletred;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form">
        <?php
        if (isset($_SESSION['message'])): ?>

            <div style="display:flex; top:30px;" class="alert alert-<?= $_SESSION['msg_type'] ?> fade show" role="alert">

                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);

                ?>


                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

    <div class="member-table">
    <!-- <h2>Library Member Records</h2> -->
    <h3 class="center-title display-5">Library Member Records</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Member ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Birthday</th>
                <th>Email address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="SELECT * FROM member";
            $result=$database->query($sql);
            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['member_id'];?></td>
                <td><?php echo $row['first_name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['birthday'];?></td>
                <td><?php echo $row['email'];?></td>
                <td>
                <a href="member_registration.php?edit=<?php echo $row['member_id']; ?>"><button style="background-color:#007bff;; color: white;">Edit</button></a>
                    <a href="member_registration.php? delete=<?php echo $row['member_id']; ?>" onclick="return confirm('Are you sure you want to delete this category?')"><button>Delete</button></a> 
                </td>
            </tr>
            <?php }
            }else{
                echo "<tr><td colspan='6'>No results</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>

    <div class="form-container">
    <h3 class="center-title display-5">Register Library Members</h3>
    <!-- <h2>Register Library Members</h2> -->
    <!-- Centering can be handled via CSS -->
    <!-- <?php if($update==true):  ?>
        <h4>Edit InformatInforma:</h4>
    <?php else: ?>
        <h4>ADD Information:</h4>
    <?php endif; ?>
     -->
    <form id="member-form" method="POST" action="mem_process.php">
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" placeholder="M001" value="<?php if(isset($member_id)) echo $member_id; ?>" required pattern="M\d{3}" title="User ID must be in the format M001">
        
        <label for="first_name">Firstname:</label>
        <input type="text" id="first_name" name="first_name" value="<?php if(isset($first_name)) echo $first_name; ?>" required>
        
        <label for="last_name">Lastname:</label>
        <input type="text" id="last_name" name="last_name" value="<?php if(isset($last_name)) echo $last_name; ?>" required>
        
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="<?php if(isset($birthday)) echo $birthday; ?>" required>
        
        <label for="email">Email address:</label>
        <input type="email" id="email" name="email" placeholder="sample@mymail.com" value="<?php if(isset($email)) echo $email; ?>" required>
        
        <?php
                        if ($update == true):
                            ?>
                            <button type="submit"  name="update">update</button>
                            
 
                        <?php else: ?>
                            <button type="submit" name="save">Add</button>

                        <?php endif; ?>
    
    </form>
</div>


</div>
<script>
    function validateForm() {
        // Email validation
        var email = document.getElementById("email").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // Member ID validation
        var memberID = document.getElementById("member_id").value;
        var memberIDRegex = /^M\d{3}$/;
        if (!memberIDRegex.test(memberID)) {
            alert("Please enter a valid Member ID in the format 'M001'.");
            return false;
        }

        return true; // Form submission allowed
    }
</script>



<!-- <script>
    document.getElementById('member-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Validate Member ID format
        const memberIDInput = document.getElementById('member_id');
        const memberIDValue = memberIDInput.value;
        const memberIDRegex = /^M\d{3}$/;
        if (!memberIDRegex.test(memberIDValue)) {
            alert('Member ID should be in the format "M001".');
            return;
        }

        // Validate Email format
        const emailInput = document.getElementById('email');
        const emailValue = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailValue)) {
            alert('Invalid email address format.');
            return;
        }

        // If both validations pass, submit the form
        this.submit();
    });

    // JavaScript functions for editing and deleting rows
    // Your existing JavaScript functions here
</script> -->

</body>
</html>
