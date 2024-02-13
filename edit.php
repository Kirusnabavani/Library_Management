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
                                    <td>
                                        <?php echo $row['borrow_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['book_id ']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['member_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['borrow_status']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['borrower_date_modified']; ?>
                                    </td>

                                    <td>
                                        <a href="index.php?edit=<?php echo $row['Sid']; ?>"><button
                                                class="btn btn-success">Edit</button></a>

                                        <a href="process.php?delete=<?php echo $row['Sid'] ?>" class="btn btn-danger btn-xl"
                                            style="display: inline !important;">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
        </tbody>
    </table>