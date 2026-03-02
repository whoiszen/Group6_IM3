<?php
include "db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO rooms (room_number, room_type, room_status, room_price, room_description) 
         VALUES (?, ?, ?, ?, ?)"
    );
    
    mysqli_stmt_bind_param(
        $stmt,
        "sssds",
        $_POST['room_number'],
        $_POST['room_type'],
        $_POST['room_status'],
        $_POST['room_price'],
        $_POST['room_description']
    );
    
    if(mysqli_stmt_execute($stmt)){
        header("Location: view_rooms.php");
        exit;
    } else {
        $error = "Something went wrong. Please try again.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Room</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body { display:flex; background:#f4f6f9; }

/* Sidebar */
.sidebar {
    width:250px; height:100vh;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    padding:30px 20px; color:white; position:fixed;
}
.sidebar h2 { margin-bottom:40px; text-align:center; }
.sidebar a {
    display:block; padding:12px 15px; margin-bottom:10px;
    color:white; text-decoration:none; border-radius:8px; transition:0.3s;
}
.sidebar a:hover { background:rgba(255,255,255,0.2); transform:translateX(5px); }

/* Main */
.main-content { margin-left:250px; padding:40px; width:100%; }
.page-title { font-size:24px; margin-bottom:25px; font-weight:600; }

.card {
    background:white; padding:35px;
    border-radius:15px; box-shadow:0 6px 15px rgba(0,0,0,0.05);
    max-width:650px;
}

form { display:flex; flex-direction:column; }

label { margin-top:15px; font-size:14px; font-weight:500; color:#555; }

input, select, textarea {
    padding:12px; margin-top:6px;
    border-radius:8px; border:1px solid #ddd;
    font-size:14px; transition:0.3s;
}

input:focus, select:focus, textarea:focus {
    outline:none; border-color:#2a5298;
    box-shadow:0 0 0 3px rgba(42,82,152,0.1);
}

textarea { resize:vertical; min-height:80px; }

button {
    margin-top:25px; padding:12px;
    border:none; border-radius:8px;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    color:white; font-size:15px;
    cursor:pointer; transition:0.3s;
}
button:hover { transform:translateY(-2px); }

.error {
    background:#ffe5e5; color:#cc0000;
    padding:10px; border-radius:8px; margin-bottom:15px;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>🏨 Hotel Admin</h2>
    <a href="index.php">📊 Dashboard</a>
    <a href="add_guests.php">➕ Add Guest</a>
    <a href="add_rooms.php">➕ Add Room</a>
    <a href="add_reservations.php">➕ Add Reservation</a>
    <a href="view_guests.php">👥 View Guests</a>
    <a href="view_rooms.php">🛏 View Rooms</a>
    <a href="view_reservations.php">📅 View Reservations</a>
</div>

<div class="main-content">
    <div class="page-title">Add New Room</div>

    <div class="card">
        <?php if($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Room Number</label>
            <input type="text" name="room_number" required>

            <label>Room Type</label>
            <select name="room_type" required>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Suite">Suite</option>
            </select>

            <label>Room Status</label>
            <select name="room_status" required>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
                <option value="Maintenance">Maintenance</option>
            </select>

            <label>Room Price (per night)</label>
            <input type="number" step="0.01" name="room_price" required>

            <label>Description</label>
            <textarea name="room_description"></textarea>

            <button type="submit">Save Room</button>
        </form>
    </div>
</div>

</body>
</html>