<?php
require_once("pro.php");
require_once("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fine</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
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



<div class="fine-table">
    <!-- <h2>Assigned Fine Records</h2> -->
    <h3 class="center-title display-5">Assigned Fine Records</h3>
    <table id="fine-records">
        <thead>
            <tr>
                <th>Fine ID</th>
                <th>Book id</th>
                <th>Member ID</th>
                <th>Fine Amount (LKR)</th>
                <th>Date Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Records will be dynamically added here -->
            
            <?php
            $sql="SELECT * FROM fine";
            $result=$database->query($sql);
            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['fine_id'];?></td>
                <td><?php echo $row['member_id'];?></td>
                <td><?php echo $row['book_id'];?></td>
                <td><?php echo $row['fine_amount'];?></td>
                <td><?php echo $row['fine_date_modified']; ?></td>
                <td>
                    <a href="fine.php? edit=<?php echo $row['fine_id']; ?>"><button style="background-color:#007bff;; color: white;">Edit</button></a>
                    <a href="fine.php? delete=<?php echo $row['fine_id']; ?>"><button>Delete</button></a> 
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
    <!-- <h2>Assign Fines</h2> -->
    <h3 class="center-title display-5">Assign Fines</h3>
    <!-- <?php if($update==true):  ?>
        <h2>Edit Info</h2>
    <?php else: ?>
        <h2>Add Info</h2>
    <?php endif; ?> -->
    <form id="fine-form" method="POST" action="pro.php">
        <label for="fine_id">Fine ID:</label>
        <input type="text" id="fine_id" name="fine_id" placeholder="F001" value="<?php if(isset($fine_id)) echo $fine_id; ?>" required>
        
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" placeholder="M001" value="<?php if(isset($member_id)) echo $member_id; ?>"  required>
        
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" placeholder="B001" value="<?php if(isset($book_id)) echo $book_id; ?>"  required>
        
        <label for="fine_amount">Fine Amount (LKR):</label>
        <input type="number" id="fine_amount" name="fine_amount" placeholder="Enter fine amount" min="2" max="500" value="<?php if(isset($fine_amount)) echo $fine_amount; ?>"  required>
        
        <?php
                        if ($update == true):
                            ?>
                            <button type="submit"  name="update">update</button>
                            
 
                        <?php else: ?>
                            <button type="submit" name="save">Add</button>

        <?php endif; ?>
    
    </form>
</div>


</body>
</html>