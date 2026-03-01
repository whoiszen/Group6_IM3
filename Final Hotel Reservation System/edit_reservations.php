<?php
include "db_connect.php";

$id = (int)$_GET['id'];

/* Fetch existing */
$stmt = mysqli_prepare($conn, "SELECT * FROM reservations WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$reservation = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$reservation) {
    die("Reservation not found.");
}

/* Update */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE reservations SET
        guest_id = ?, room_id = ?, check_in_date = ?, check_out_date = ?,
        number_of_guests = ?, total_price = ?, booking_status = ?
        WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iissidsi",
        $_POST['guest_id'],
        $_POST['room_id'],
        $_POST['check_in_date'],
        $_POST['check_out_date'],
        $_POST['number_of_guests'],
        $_POST['total_price'],
        $_POST['booking_status'],
        $id
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: view_reservations.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this reservation?");
        }
    </script>
</head>
<body>

<h2>Edit Reservation</h2>

<form method="POST" onsubmit="return confirmUpdate();">
    <label>Guest ID:</label><br>
    <input type="text" name="guest_id" value="<?= $reservation['guest_id'] ?>" required><br><br>

    <label>Room ID:</label><br>
    <input type="text" name="room_id" value="<?= $reservation['room_id'] ?>" required><br><br>

    <label>Check-in Date:</label><br>
    <input type="date" name="check_in_date" value="<?= $reservation['check_in_date'] ?>" required><br><br>

    <label>Check-out Date:</label><br>
    <input type="date" name="check_out_date" value="<?= $reservation['check_out_date'] ?>" required><br><br>

    <label>Number of Guests:</label><br>
    <input type="number" name="number_of_guests" value="<?= $reservation['number_of_guests'] ?>" required><br><br>

    <label>Total Price:</label><br>
    <input type="text" name="total_price" value="<?= $reservation['total_price'] ?>" required><br><br>

    <label>Booking Status:</label><br>
    <input type="text" name="booking_status" value="<?= $reservation['booking_status'] ?>" required><br><br>


    <button type="submit">Update</button>
</form>

</body>
</html>
