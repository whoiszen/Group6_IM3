<?php
include "db_connect.php";

$sql = "SELECT * FROM guests ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Guests</title>
    <!-- Include same styles as view_reservations.php -->
</head>
<body>
    <h2>Guest List</h2>
    <a href="add_guests.php">Add New Guest</a>
    
    <div class="table-card">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['address'] ?></td>
                <td>
                    <a href="delete_guests.php?id=<?= $row['id'] ?>" 
                       onclick="return confirm('Delete this guest?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
