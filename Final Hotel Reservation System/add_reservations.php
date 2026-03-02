<?php
include "db_connect.php";

$guests = mysqli_query($conn, "SELECT id, first_name, last_name FROM guests ORDER BY first_name");
$rooms = mysqli_query($conn, "SELECT id, room_number, room_type, room_price FROM rooms WHERE room_status = 'Available'");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Reservation</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body { display:flex; background:#f4f6f9; }

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

.main-content { margin-left:250px; padding:40px; width:100%; }

.card {
    background:white; padding:35px;
    border-radius:15px; box-shadow:0 6px 15px rgba(0,0,0,0.05);
    max-width:750px;
}

form { display:flex; flex-direction:column; }

label { margin-top:15px; font-size:14px; font-weight:500; color:#555; }

input, select {
    padding:12px; margin-top:6px;
    border-radius:8px; border:1px solid #ddd;
    font-size:14px; transition:0.3s;
}

input:focus, select:focus {
    outline:none; border-color:#2a5298;
    box-shadow:0 0 0 3px rgba(42,82,152,0.1);
}

button {
    margin-top:25px; padding:12px;
    border:none; border-radius:8px;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    color:white; font-size:15px;
    cursor:pointer; transition:0.3s;
}
button:hover { transform:translateY(-2px); }
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
    <h2 style="margin-bottom:25px;">Add New Reservation</h2>

    <div class="card">
        <form action="insert_reservations.php" method="POST">

            <label>Select Guest</label>
            <select name="guest_id" required>
                <option value="">-- Select Guest --</option>
                <?php while($guest = mysqli_fetch_assoc($guests)): ?>
                <option value="<?= $guest['id'] ?>">
                    <?= $guest['first_name'] . ' ' . $guest['last_name'] ?>
                </option>
                <?php endwhile; ?>
            </select>

            <label>Select Room</label>
            <select name="room_id" required>
                <option value="">-- Select Room --</option>
                <?php while($room = mysqli_fetch_assoc($rooms)): ?>
                <option value="<?= $room['id'] ?>">
                    Room <?= $room['room_number'] ?> 
                    (<?= $room['room_type'] ?>) 
                    - ₱<?= $room['room_price'] ?>/night
                </option>
                <?php endwhile; ?>
            </select>

            <label>Check-in Date</label>
            <input type="date" name="check_in_date" required>

            <label>Check-out Date</label>
            <input type="date" name="check_out_date" required>

            <label>Number of Guests</label>
            <input type="number" name="number_of_guests" min="1" required>

            <label>Booking Status</label>
            <select name="booking_status" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed" selected>Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <button type="submit">Save Reservation</button>

        </form>
    </div>
</div>

</body>
</html>