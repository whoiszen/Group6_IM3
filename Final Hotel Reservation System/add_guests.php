<?php
include "db_connect.php";

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
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Guest</title>
    <style>
        /* Use same styling as your reservation form */
    </style>
</head>
<body>
    <h2>Add New Guest</h2>
    <div class="card">
        <form method="POST">
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
</body>
</html>
