<?php 
require_once("brprocess.php");
require_once("./config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        .book-table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .book-table h2 {
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


<div class="book-table">
    <h3 class="center-title display-5">Book Records</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Book Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM book";
            $result=$database->query($sql);
            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['book_id'];?></td>
                <td><?php echo $row['book_name'];?></td>
                <td><?php echo $row['category_id'];?></td>
                
                <td>
                <a href="book_registration.php?edit=<?php echo $row['book_id']; ?>"><button style="background-color:#007bff;; color: white;">Edit</button></a>
                <a href="book_registration.php? delete=<?php echo $row['book_id']; ?>"><button>Delete</button></a> 
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
    <h3 class="center-title display-5">Book Registration</h3>
    <!-- <?php if($update==true):  ?>
        <h2>Edit Info</h2>
    <?php else: ?>
        <h2>Add Info</h2>
    <?php endif; ?> -->

    <form id="book-form" method="post" action="brprocess.php">

        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" placeholder="B001" value="<?php if(isset($book_id)) echo $book_id; ?>" required pattern="B\d{3}" onchange="checkDuplicateBookId()">

        <label for="book_name">Book Name:</label>
        <input type="text" id="book_name" name="book_name" value="<?php if(isset($book_name)) echo $book_name; ?>" required>

        <label for="category_id">Book Category:</label>
        <input type="text" id="category_id" name="category_id" placeholder="C001" value="<?php if(isset($category_id)) echo $category_id; ?>" required>

        <?php
                        if ($update == true):
                            ?>
                            <button type="submit"  name="update">update</button>
                            
 
                        <?php else: ?>
                            <button type="submit" name="save">Add</button>

        <?php endif; ?>
    </form>
</div>

<script>
    function checkDuplicateBookId() {
        var bookId = document.getElementById("book_id").value;
        var bookIds = <?php echo json_encode($bookIds); ?>; // Assuming $bookIds is an array of existing book IDs

        if (bookIds.includes(bookId)) {
            alert('This Book ID already exists! Please enter a different Book ID.');
            document.getElementById("book_id").value = ""; // Clear the input field
        }
    }
</script>

</body>
</html>