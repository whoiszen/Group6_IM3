<?php
include "db_connect.php";

$guest_id = 1; // Example guest ID
$room_id = 1; // Example room ID
$check_in_date = "2023-10-01";
$check_out_date = "2023-10-05";
$number_of_guests = 2;
$total_price = 500.00;
$booking_status = "Confirmed";

$data = "INSERT INTO reservations (guest_id, room_id, check_in_date, check_out_date, number_of_guests, total_price, booking_status) VALUES ('$guest_id', '$room_id', '$check_in_date', '$check_out_date', '$number_of_guests', '$total_price', '$booking_status')";

$table = "CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guest_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    number_of_guests INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    booking_status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
)";


if(mysqli_query($conn, $data)){
    echo "Reservations 'data' created successfully";
}else{
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>