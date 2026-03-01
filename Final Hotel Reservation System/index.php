<?php include "db_connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation System</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .menu { display: flex; gap: 10px; margin-bottom: 20px; }
        .menu a { 
            padding: 10px 20px; 
            background: #4CAF50; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
        }
        .stats { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 20px; 
            margin-top: 20px; 
        }
        .stat-card { 
            padding: 20px; 
            background: #f0f0f0; 
            border-radius: 5px; 
            text-align: center; 
        }
        .stat-number { font-size: 24px; font-weight: bold; color: #4CAF50; }
    </style>
</head>
<body>
    <h1>Hotel Reservation System</h1>
    
    <div class="menu">
        <a href="add_guests.php">Add Guest</a>
        <a href="add_rooms.php">Add Room</a>
        <a href="add_reservation.php">Add Reservation</a>
        <a href="view_guests.php">View Guests</a>
        <a href="view_rooms.php">View Rooms</a>
        <a href="view_reservations.php">View Reservations</a>
    </div>
    
    <?php
    $guests = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM guests"));
    $rooms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM rooms"));
    $reservations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations"));
    ?>
    
    <div class="stats">
        <div class="stat-card">
            <div>Total Guests</div>
            <div class="stat-number"><?= $guests['total'] ?></div>
        </div>
        <div class="stat-card">
            <div>Total Rooms</div>
            <div class="stat-number"><?= $rooms['total'] ?></div>
        </div>
        <div class="stat-card">
            <div>Total Reservations</div>
            <div class="stat-number"><?= $reservations['total'] ?></div>
        </div>
    </div>
</body>
</html>