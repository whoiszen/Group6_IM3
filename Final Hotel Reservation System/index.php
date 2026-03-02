<?php include "db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Reservation Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            background-color: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            padding: 30px 20px;
            color: white;
            position: fixed;
        }

        .sidebar h2 {
            margin-bottom: 40px;
            font-weight: 600;
            text-align: center;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            font-size: 22px;
            color: #333;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 16px;
            color: #777;
            margin-bottom: 15px;
        }

        .card .number {
            font-size: 32px;
            font-weight: 600;
            color: #2a5298;
        }

        /* Responsive */
        @media(max-width: 768px){
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>

<?php
$guests = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM guests"));
$rooms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM rooms"));
$reservations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations"));
?>

<!-- Sidebar -->
<div class="sidebar">
    <h2>🏨 Hotel Admin</h2>
    <a href="add_guests.php">➕ Add Guest</a>
    <a href="add_rooms.php">➕ Add Room</a>
    <a href="add_reservations.php">➕ Add Reservation</a>
    <a href="view_guests.php">👥 View Guests</a>
    <a href="view_rooms.php">🛏 View Rooms</a>
    <a href="view_reservations.php">📅 View Reservations</a>
</div>

<!-- Main Content -->
<div class="main-content">

    <div class="topbar">
        <h1>Dashboard Overview</h1>
        <div>Welcome, Admin 👋</div>
    </div>

    <div class="stats">
        <div class="card">
            <h3>Total Guests</h3>
            <div class="number"><?= $guests['total'] ?></div>
        </div>

        <div class="card">
            <h3>Total Rooms</h3>
            <div class="number"><?= $rooms['total'] ?></div>
        </div>

        <div class="card">
            <h3>Total Reservations</h3>
            <div class="number"><?= $reservations['total'] ?></div>
        </div>
    </div>

</div>

</body>
</html>