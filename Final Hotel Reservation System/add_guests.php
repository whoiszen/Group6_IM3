<?php
include "db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO guests (first_name, last_name, email, phone, address) 
         VALUES (?, ?, ?, ?, ?)"
    );
    
    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address']
    );
    
    if(mysqli_stmt_execute($stmt)){
        header("Location: view_guests.php");
        exit;
    } else {
        $error = "Something went wrong. Please try again.";
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Guest</title>

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
    padding: 40px;
    width: 100%;
}

.page-title {
    font-size: 24px;
    margin-bottom: 25px;
    font-weight: 600;
    color: #333;
}

/* Card */
.card {
    background: white;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    max-width: 600px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 15px;
    font-size: 14px;
    font-weight: 500;
    color: #555;
}

input {
    padding: 12px;
    margin-top: 6px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: 0.3s;
}

input:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
}

/* Button */
button {
    margin-top: 25px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: white;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

/* Error */
.error {
    background: #ffe5e5;
    color: #cc0000;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}

@media(max-width: 768px){
    .sidebar {
        width: 200px;
    }

    .main-content {
        margin-left: 200px;
        padding: 20px;
    }

    .card {
        padding: 20px;
    }
}
</style>
</head>
<body>

<!-- Sidebar -->
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

<!-- Main Content -->
<div class="main-content">

    <div class="page-title">Add New Guest</div>

    <div class="card">
        <?php if($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="add_guests.php">
            <label>First Name</label>
            <input type="text" name="first_name" required>

            <label>Last Name</label>
            <input type="text" name="last_name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Phone</label>
            <input type="text" name="phone" required>

            <label>Address</label>
            <input type="text" name="address" required>

            <button type="submit">Save Guest</button>
        </form>
    </div>

</div>

</body>
</html>