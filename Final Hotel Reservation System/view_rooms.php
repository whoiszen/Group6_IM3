<?php
include "db_connect.php";
$sql = "SELECT * FROM rooms ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>View Rooms</title>
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
.sidebar a:hover{
    background:rgba(255,255,255,0.2);
    transform:translateX(5px);
}

.main-content{margin-left:250px;padding:40px;width:100%;}
.header{
    display:flex;justify-content:space-between;
    align-items:center;margin-bottom:25px;
}
.add-btn{
    background:#2a5298;color:white;
    padding:10px 18px;border-radius:8px;
    text-decoration:none;transition:0.3s;
}
.add-btn:hover{background:#1e3c72;}

.card{
    background:white;padding:25px;
    border-radius:15px;
    box-shadow:0 6px 15px rgba(0,0,0,0.05);
}

table{width:100%;border-collapse:collapse;}
th,td{padding:14px;text-align:left;font-size:14px;}
th{background:#f0f2f7;}
tr{border-bottom:1px solid #eee;}
tr:hover{background:#f9fbff;}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:500;
}
.available{background:#d4edda;color:#155724;}
.occupied{background:#f8d7da;color:#721c24;}
.maintenance{background:#fff3cd;color:#856404;}

.btn{
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
    margin-right:5px;
}
.edit{background:#ffc107;color:#000;}
.delete{background:#dc3545;color:white;}
</style>
</head>

<body>

<div class="sidebar">
    <h2>🏨 Hotel Admin</h2>
    <a href="index.php">📊 Dashboard</a>
    <a href="view_guests.php">👥 Guests</a>
    <a href="view_rooms.php">🛏 Rooms</a>
    <a href="view_reservations.php">📅 Reservations</a>
</div>

<div class="main-content">

    <div class="header">
        <h2>Room List</h2>
        <a href="add_rooms.php" class="add-btn">+ Add Room</a>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>ID</th>
                <th>Room Number</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['room_number'] ?></td>
                <td><?= $row['room_type'] ?></td>
                <td>₱<?= number_format($row['room_price'],2) ?></td>
                <td>
                    <span class="badge <?= strtolower($row['room_status']) ?>">
                        <?= $row['room_status'] ?>
                    </span>
                </td>
                <td>
                    <a class="btn edit" href="edit_rooms.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="btn delete"
                       href="delete_rooms.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this room?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</div>

</body>
</html>