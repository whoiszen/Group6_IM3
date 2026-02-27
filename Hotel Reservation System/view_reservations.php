<?php
include "db_connect.php";

$sql = "SELECT * FROM reservations ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Reservations</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this reservation?");
        }
       
    </script>
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    h2 {
        margin-top: 40px;
        color: #2c3e50;
    }

    /* Card container */
    .card {
        background: #ffffff;
        max-width: 600px;
        margin-bottom: 30px;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Form styles */
    label {
        font-weight: 600;
        display: block;
        margin-top: 15px;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    button {
        margin-top: 20px;
        padding: 10px 18px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Table card */
    .table-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f1f3f5;
        font-weight: 600;
    }

    tr:nth-child(even) {
        background-color: #fafafa;
    }

    a {
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
    }

    a:hover {
        text-decoration: underline;
    }

    .action-links a {
        margin-right: 8px;
    }
</style>

</head>
<body>
    <h2>Add Reservation</h2>
   <div class="card">
    <form action="insert_reservations.php" method="POST">
        <label>Guest ID</label>
        <input type="text" name="guest_id" required>

        <label>Room ID</label>
        <input type="text" name="room_id" required>

        <label>Check-in Date</label>
        <input type="text" name="check_in_date" required>

        <label>Check-out Date</label>
        <input type="text" name="check_out_date" required>

        <label>Number of Guests</label>
        <input type="text" name="number_of_guests" required>

        <label>Total Price</label>
        <input type="text" name="total_price" required>

        <label>Booking Status</label>
        <input type="text" name="booking_status" required>

        <button type="submit">Save Reservation</button>
    </form>
</div>
<h2>Reservation List</h2>

<div class="table-card">
<table>
<tr>
    <th>Guest_ID</th>
    <th>Room_ID</th>
    <th>Check-in Date</th>
    <th>Check-out Date</th>
    <th>Number of Guests</th>
    <th>Price</th>
    <th>Booking Status</th>
    <th>Actions</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $row['guest_id'] ?></td>
    <td><?= $row['room_id'] ?></td>
    <td><?= $row['check_in_date'] ?></td>
    <td><?= $row['check_out_date'] ?></td>
    <td><?= $row['number_of_guests'] ?></td>
    <td><?= $row['total_price'] ?></td>
    <td><?= $row['booking_status'] ?></td>

    <td class="action-links">
        <a href="edit_reservations.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete_reservations.php?id=<?= $row['id'] ?>" 
        onclick="return confirmDelete();">
        Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</div>


</table>
</body>
</html>

<?php mysqli_close($conn); ?>
