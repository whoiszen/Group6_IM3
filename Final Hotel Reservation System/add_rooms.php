<?php
include "db_connect.php";

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
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
</head>
<body>
    <h2>Add New Room</h2>
    <div class="card">
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
</body>
</html>
