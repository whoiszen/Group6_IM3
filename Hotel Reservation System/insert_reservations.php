<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO reservations 
        (guest_id, room_id, check_in_date, check_out_date, number_of_guests, total_price, booking_status)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iissids",
        $_POST['guest_id'],
        $_POST['room_id'],
        $_POST['check_in_date'],
        $_POST['check_out_date'],
        $_POST['number_of_guests'],
        $_POST['total_price'],
        $_POST['booking_status']
    );
    if(mysqli_stmt_execute($stmt)){
            echo "Reservation inserted successfully";
        }else{
            echo "Insert Failed";
        }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

header("Location: view_reservations.php");
exit;
?>