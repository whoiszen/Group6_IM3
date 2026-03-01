<?php
include "db_connect.php";

// $first_name = "John";
// $last_name = "Doe";
// $email = "john.doe@example.com";
// $phone = "123-456-7890";
// $address = "123 Main St, Anytown, USA";

// $data = "INSERT INTO guests (first_name, last_name, email, phone, address) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";

$table = "CREATE TABLE IF NOT EXISTS guests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($conn, $table)){
    echo "Guests table created successfully";
}else{
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>