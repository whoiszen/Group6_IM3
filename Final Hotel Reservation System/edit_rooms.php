<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE rooms SET room_number=?, room_type=?, room_price=? WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssdi",
        $_POST['room_number'],
        $_POST['room_type'],
        $_POST['room_price'],
        $_POST['id']
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_rooms.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

if (isset($_GET['id'])) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM rooms WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $room = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this room?");
        }
    </script>
</head>
<body>
    <h2>Edit Room</h2>
    <div class="card">
        <form method="POST" onsubmit="return confirmUpdate();">
            <input type="hidden" name="id" value="<?= $room['id'] ?>">
            <label>Room Number</label>
            <input type="text" name="room_number" value="<?= $room['room_number'] ?>" required>

            <label>Room Type</label>
            <input type="text" name="room_type" value="<?= $room['room_type'] ?>" required>

            <label>Room Price</label>
            <input type="number" name="room_price" value="<?= $room['room_price'] ?>" required>

            <button type="submit">Update Room</button>
        </form>
    </div>
</body>
</html>
