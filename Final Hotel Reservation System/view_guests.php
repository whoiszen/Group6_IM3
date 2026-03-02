<?php
include "db_connect.php";
$sql = "SELECT * FROM guests ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>View Guests</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f4f6f9;}
.sidebar{
    width:250px;height:100vh;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    padding:30px 20px;color:white;position:fixed;
}
.sidebar h2{margin-bottom:40px;text-align:center;}
.sidebar a{
    display:block;padding:12px;margin-bottom:10px;
    color:white;text-decoration:none;border-radius:8px;transition:0.3s;
}
.sidebar a:hover{background:rgba(255,255,255,0.2);transform:translateX(5px);}
.main-content{margin-left:250px;padding:40px;width:100%;}
.page-header{
    display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;
}
.add-btn{
    padding:10px 18px;background:#2a5298;color:white;
    text-decoration:none;border-radius:8px;transition:0.3s;
}
.add-btn:hover{background:#1e3c72;}
.table-card{
    background:white;padding:25px;border-radius:15px;
    box-shadow:0 6px 15px rgba(0,0,0,0.05);
}
table{width:100%;border-collapse:collapse;}
th,td{padding:12px;text-align:left;font-size:14px;}
th{background:#f0f2f7;}
tr{border-bottom:1px solid #eee;}
tr:hover{background:#f9fbff;}
.action-btn{
    padding:6px 12px;border-radius:6px;
    text-decoration:none;font-size:12px;margin-right:5px;
}
.edit{background:#ffc107;color:#000;}
.delete{background:#dc3545;color:white;}
</style>
</head>

<body>

<div class="sidebar">
    <h2>🏨 Hotel Admin</h2>
    <a href="index.php">📊 Dashboard</a>
    <a href="add_guests.php">➕ Add Guest</a>
    <a href="view_guests.php">👥 View Guests</a>
    <a href="view_rooms.php">🛏 View Rooms</a>
    <a href="view_reservations.php">📅 View Reservations</a>
</div>

<div class="main-content">

    <div class="page-header">
        <h2>Guest List</h2>
        <a href="add_guests.php" class="add-btn">+ Add New Guest</a>
    </div>

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
                <td><?= $row['first_name'].' '.$row['last_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['address'] ?></td>
                <td>
                    <a class="action-btn edit" href="edit_guests.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="action-btn delete" 
                       href="delete_guests.php?id=<?= $row['id'] ?>" 
                       onclick="return confirm('Delete this guest?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</div>
</body>
</html>