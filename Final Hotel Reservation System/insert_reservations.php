<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_id = $_POST['guest_id'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in_date'];
    $check_out = $_POST['check_out_date'];
    $guests = $_POST['number_of_guests'];
    $status = $_POST['booking_status'];
    
    // Get room price
    $room = mysqli_query($conn, "SELECT room_price FROM rooms WHERE id = $room_id");
    $room_data = mysqli_fetch_assoc($room);
    
    // Calculate total
    $days = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
    $total = $days * $room_data['room_price'];
    
    $sql = "INSERT INTO reservations (guest_id, room_id, check_in_date, check_out_date, 
            number_of_guests, total_price, booking_status) 
            VALUES ($guest_id, $room_id, '$check_in', '$check_out', $guests, $total, '$status')";
    
    if(mysqli_query($conn, $sql)) {
        // Update room status to Occupied
        mysqli_query($conn, "UPDATE rooms SET room_status = 'Occupied' WHERE id = $room_id");
        
        header("Location: view_reservations.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>