<?php
require_once('process.php');
require_once('./config.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Borrow System</title>
    <style>
        /* CSS styles for the form and table */
body {
    background-image: url('img/Library.jpg');
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
.edit-btn{
    background-color: #007bff;
}
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
<div class="form-container">
        <h3 class="center-title"> Add Borrow Details</h3>

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

    <form id="borrow-form" action="process.php" method="POST">
        <label for="borrow_id">Borrow ID:</label>
        <input type="text" id="borrow_id" name="borrow_id" placeholder="BR001" required pattern="BR\d{3}" value="<?php if(isset($edit_borrow_id)) echo $edit_borrow_id; ?>">
        
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" placeholder="B001" required pattern="B\d{3}" value="<?php if(isset($edit_book_id)) echo $edit_book_id; ?>">
        
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" placeholder="M001" required pattern="M\d{3}" value="<?php if(isset($edit_member_id)) echo $edit_member_id; ?>">
        
        <label for="borrow_status">Borrow Status:</label>
        <select id="borrow_status" name="borrow_status" required>
            <option value="borrowed" <?php if(isset($edit_borrow_status) && $edit_borrow_status == 'borrowed') echo 'selected'; ?>>Borrowed</option>
            <option value="available" <?php if(isset($edit_borrow_status) && $edit_borrow_status == 'available') echo 'selected'; ?>>Available</option>
        </select>
        
        <!-- <button type="submit" name="Add_borrow">Add Borrow</button> -->
        <?php
                        if ($update == true):
                            ?>
                            <button type="submit"  name="update">update borrow</button>
                            
 
                        <?php else: ?>
                            <button type="submit" name="Add_borrow">Add Borrow</button>

                        <?php endif; ?>
    </form>
</div>
<div class="borrow-table">
    <h3 class="center-title">Borrow Book Records</h3>
    <table id="borrow-records">
    <thead>
        <tr>
            <th>BorrowID</th>
            <th>BookID</th>
            <th>MemberID</th>
            <th>Borrow Status</th>
            <th>Date Modified</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM bookborrower";
        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['borrow_id']; ?></td>
            <td><?php echo $row['book_id']; ?></td>
            <td><?php echo $row['member_id']; ?></td>
            <td><?php echo $row['borrow_status']; ?></td>
            <td><?php echo $row['borrower_date_modified']; ?></td>
            <td>
                
                <a class="edit-btn" href="book_borrow.php?edit=<?php echo $row['borrow_id']; ?>">
                <button style="background-color: #007bff; color: #fff;">Edit</button></a>
                <a href="process.php?delete=<?php echo $row['borrow_id']; ?>"><button>Delete</button></a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }
        $database->close();
        ?>
    </tbody>
</table>
    
</body>
</html>
