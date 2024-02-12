<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Borrow System</title>
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
select {
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

.borrow-table {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.borrow-table h2 {
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
    <h2>Add Borrow Details</h2>
    <form id="borrow-form">
        <label for="borrow_id">Borrow ID:</label>
        <input type="text" id="borrow_id" name="borrow_id" placeholder="BR001" required pattern="BR\d{3}">
        
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" placeholder="B001" required pattern="B\d{3}">
        
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" placeholder="M001" required pattern="M\d{3}">
        
        <label for="borrow_status">Borrow Status:</label>
        <select id="borrow_status" name="borrow_status" required>
            <option value="borrowed">Borrowed</option>
            <option value="available">Available</option>
        </select>
        
        <button type="submit">Add Borrow</button>
    </form>
</div>

<div class="borrow-table">
    <h2>Borrow Book Records</h2>
    <table id="borrow-records">
        <thead>
            <tr>
                <th>BookID</th>
                <th>Member</th>
                <th>Book Name</th>
                <th>Borrow Status</th>
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
    document.getElementById('borrow-form').addEventListener('submit', function(event){
    event.preventDefault(); // Prevent the form from submitting

    // Get form values
    const borrowID = document.getElementById('borrow_id').value;
    const bookID = document.getElementById('book_id').value;
    const memberID = document.getElementById('member_id').value;
    const borrowStatus = document.getElementById('borrow_status').value;

    // Create a new row in the table
    const table = document.getElementById('borrow-records').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow(table.rows.length);

    // Insert cells into the new row
    const cellBookID = newRow.insertCell(0);
    const cellMember = newRow.insertCell(1);
    const cellBookName = newRow.insertCell(2);
    const cellBorrowStatus = newRow.insertCell(3);
    const cellDateModified = newRow.insertCell(4);
    const cellActions = newRow.insertCell(5);

    // Add values to the cells
    // For demonstration purposes, I'm setting the date modified as the current date
    const currentDate = new Date().toLocaleDateString();
    cellBookID.innerHTML = bookID;
    cellMember.innerHTML = memberID;
    cellBookName.innerHTML = "Book Name"; // You can replace this with the actual book name
    cellBorrowStatus.innerHTML = borrowStatus;
    cellDateModified.innerHTML = currentDate;
    cellActions.innerHTML = '<button onclick="editRow(this)">Edit</button><button onclick="deleteRow(this)">Delete</button>';

    // Clear the form fields
    document.getElementById('borrow-form').reset();
});

function editRow(button) {
    // Get the row to be edited
    const row = button.parentNode.parentNode;

    // Populate form fields with row data
    document.getElementById('book_id').value = row.cells[0].innerHTML;
    document.getElementById('member_id').value = row.cells[1].innerHTML;
    document.getElementById('borrow_status').value = row.cells[3].innerHTML;

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