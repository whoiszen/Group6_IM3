<?php
include "db_connect.php";

$name = "aj";
$email = "aj@yahoo.com";
$course = "BSIT";

$data = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";

$table = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($conn, $data)){
    echo "Students 'data' created successfully";
}else{
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>