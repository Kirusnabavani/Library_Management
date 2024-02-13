<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Fines System</title>
    <style>
       
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
input[type="number"] {
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

.fine-table {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.fine-table h2 {
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
    <h2>Assign Fines</h2>
    <form id="fine-form">
        <label for="fine_id">Fine ID:</label>
        <input type="text" id="fine_id" name="fine_id" placeholder="F001" required>
        
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" placeholder="M001" required>
        
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" placeholder="B001" required>
        
        <label for="fine_amount">Fine Amount (LKR):</label>
        <input type="number" id="fine_amount" name="fine_amount" placeholder="Enter fine amount" min="2" max="500" required>
        
        <button type="submit">Assign Fine</button>
    </form>
</div>

<div class="fine-table">
    <h2>Assigned Fine Records</h2>
    <table id="fine-records">
        <thead>
            <tr>
                <th>Fine ID</th>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Book Name</th>
                <th>Fine Amount (LKR)</th>
                <th>Date Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Records will be dynamically added here -->
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('fine-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Get form values
            const fineId = document.getElementById('fine_id').value;
            const memberId = document.getElementById('member_id').value;
            const bookId = document.getElementById('book_id').value;
            const fineAmount = document.getElementById('fine_amount').value;

            // Create a new row in the table
            const table = document.getElementById('fine-records').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow(table.rows.length);

            // Insert cells into the new row
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);
            const cell5 = newRow.insertCell(4);
            const cell6 = newRow.insertCell(5);
            const cell7 = newRow.insertCell(6);

            // Add values to the cells
            cell1.innerHTML = fineId;
            cell2.innerHTML = memberId;
            cell3.innerHTML = 'Member Name'; // You can fetch member name using memberId
            cell4.innerHTML = 'Book Name'; // You can fetch book name using bookId
            cell5.innerHTML = fineAmount;
            cell6.innerHTML = new Date().toLocaleDateString();
            cell7.innerHTML = '<button onclick="editRow(this)">Edit</button><button onclick="deleteRow(this)">Delete</button>';

            // Clear the form fields
            document.getElementById('fine-form').reset();
        });
    });

    function editRow(button) {
        // Get the row to be edited
        const row = button.parentNode.parentNode;

        // Populate form fields with row data
        document.getElementById('fine_id').value = row.cells[0].innerHTML;
        document.getElementById('member_id').value = row.cells[1].innerHTML;
        document.getElementById('book_id').value = ''; // You can fetch book ID from row.cells[3].innerHTML
        document.getElementById('fine_amount').value = row.cells[4].innerHTML;

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