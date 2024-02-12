<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Member Registration</title>
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
        input[type="email"],
        input[type="date"] {
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

        .member-table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .member-table h2 {
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
        }

        td:last-child button:hover {
            background-color: #c82333;
        }


    </style>
</head>
<body>

<div class="form-container">
    <h2>Register Library Members</h2>
    <form id="member-form">
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" placeholder="M001" required pattern="M\d{3}">
        
        <label for="first_name">Firstname:</label>
        <input type="text" id="first_name" name="first_name" required>
        
        <label for="last_name">Lastname:</label>
        <input type="text" id="last_name" name="last_name" required>
        
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required>
        
        <label for="email">Email address:</label>
        <input type="email" id="email" name="email" placeholder="sample@mymail.com" required>
        
        <button type="submit">Register Member</button>
    </form>
</div>

<div class="member-table">
    <h2>Library Member Records</h2>
    <table id="member-records">
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
            <!-- Records will be dynamically added here -->
        </tbody>
    </table>
</div>

<script>
     document.getElementById('member-form').addEventListener('submit', function(event){
        event.preventDefault(); // Prevent the form from submitting

        // Get form values
        const memberID = document.getElementById('member_id').value;
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        const birthday = document.getElementById('birthday').value;
        const email = document.getElementById('email').value;

        // Create a new row in the table
        const table = document.getElementById('member-records').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow(table.rows.length);

        // Insert cells into the new row
        const cellID = newRow.insertCell(0);
        const cellFirstName = newRow.insertCell(1);
        const cellLastName = newRow.insertCell(2);
        const cellBirthday = newRow.insertCell(3);
        const cellEmail = newRow.insertCell(4);
        const cellActions = newRow.insertCell(5);

        // Add values to the cells
        cellID.innerHTML = memberID;
        cellFirstName.innerHTML = firstName;
        cellLastName.innerHTML = lastName;
        cellBirthday.innerHTML = birthday;
        cellEmail.innerHTML = email;
        cellActions.innerHTML = '<button onclick="editRow(this)">Edit</button><button onclick="deleteRow(this)">Delete</button>';

        // Clear the form fields
        document.getElementById('member-form').reset();
    });

    function editRow(button) {
        // Get the row to be edited
        const row = button.parentNode.parentNode;

        // Populate form fields with row data
        document.getElementById('member_id').value = row.cells[0].innerHTML;
        document.getElementById('first_name').value = row.cells[1].innerHTML;
        document.getElementById('last_name').value = row.cells[2].innerHTML;
        document.getElementById('birthday').value = row.cells[3].innerHTML;
        document.getElementById('email').value = row.cells[4].innerHTML;

        // Remove the row from the table
        row.remove();
    }

    function deleteRow(button) {
        // Get the row to be deleted
        const row = button.parentNode.parentNode;

        // Remove the row from the table
        row.remove();
    }
</script>

</body>
</html>