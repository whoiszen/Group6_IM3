<?php
include "db_connect.php";

$room_number = "R001";
$room_type = "Single";
$room_status = "Available";
$room_price = 100.00;
$room_description = "A cozy single room with all basic amenities.";


    $data = "INSERT INTO rooms (room_number, room_type, room_status, room_price, room_description) VALUES ('$room_number', '$room_type', '$room_status', '$room_price', '$room_description')";

    $table = "CREATE TABLE IF NOT EXISTS rooms (
        id INT AUTO_INCREMENT PRIMARY KEY,
        room_number VARCHAR(10) NOT NULL,
        room_type ENUM('Single', 'Double', 'Suite') NOT NULL,
        room_status ENUM('Available', 'Occupied', 'Maintenance') NOT NULL,
        room_price DECIMAL(10, 2) NOT NULL,
        room_description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
// $data = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";

// $table = "CREATE TABLE IF NOT EXISTS students (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//     course VARCHAR(100) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";

if(mysqli_query($conn, $data)){
    echo "Rooms 'data' created successfully";
}else{
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>