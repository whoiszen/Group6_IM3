<?php 
include "db_connect.php";

if (isset($_GET['id'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM rooms WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_rooms.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}