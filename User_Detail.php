<?php
require_once('config.php');

// Fetch user records from the database
$query = "SELECT * FROM user";
$result = $database->query($query);
$users = $result->fetch_all(MYSQLI_ASSOC);

// Check if form is submitted for updating user details
if (isset($_POST['edit'])) {
    $userId = $_POST['user_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to update user record
    $query = "UPDATE user SET first_name = '$firstName', last_name = '$lastName', username = '$username', email = '$email', password = '$password' WHERE user_id = '$userId'";
    $result = $database->query($query);

    if ($result) {
        // Update successful
        echo "User details updated successfully";
    } else {
        // Error occurred during update
        echo "Error updating user details";
    }
}

// Check if user_id is set in the POST request (for deletion)
if (isset($_POST['delete'])) {
    $userId = $_POST['user_id'];

    // Prepare and execute SQL query to delete the user record
    $query = "DELETE FROM user WHERE user_id = '$userId'";
    $result = $database->query($query);

    if ($result) {
        // Deletion successful
        echo "User deleted successfully";
    } else {
        // Error occurred during deletion
        echo "Error deleting user";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Details</title>
    <style>
        /* CSS styles for the form and table */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .form-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none; /* Initially hide the form */
        }

        .form-container.active {
            display: block; /* Display the form when active */
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .user-table {
            width: 100%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .user-table h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td:last-child {
            text-align: center;
        }

        td:last-child button {
            padding: 5px 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        td:last-child button.edit-btn {
            background-color: #007bff;
        }

        td:last-child button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="user-table">
    <h2>User Records</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['password']; ?></td>
                    <td>
                        <button class="edit-btn" onclick="editUser('<?php echo $user['user_id']; ?>')">Edit</button>
                        <button onclick="deleteUser('<?php echo $user['user_id']; ?>')">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="form-container" id="edit-form">
    <h2>Edit Details</h2>
    <form id="user-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" id="user_id" name="user_id">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="edit">Save Changes</button>
    </form>
</div>

<script>
    // Function to fill edit form fields with selected user's details
    function editUser(userId) {
        var user = <?php echo json_encode($users); ?>;
        var selectedUser = user.find(u => u.user_id === userId);
        
        if (selectedUser) {
            document.getElementById('user_id').value = selectedUser.user_id;
            document.getElementById('first_name').value = selectedUser.first_name;
            document.getElementById('last_name').value = selectedUser.last_name;
            document.getElementById('username').value = selectedUser.username;
            document.getElementById('email').value = selectedUser.email;
            document.getElementById('password').value = selectedUser.password;
            document.getElementById('edit-form').classList.add('active');
        }
    }

    // Function to delete a user
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status == 200) {
                    location.reload(); // Reload the page after successful deletion
                } else {
                    alert('Error deleting user');
                }
            };
            xhr.send('delete=1&user_id=' + userId);
        }
    }
</script>

</body>
</html>
