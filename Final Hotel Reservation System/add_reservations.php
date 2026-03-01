<?php
include "db_connect.php";

// Get data for dropdowns
$guests = mysqli_query($conn, "SELECT id, first_name, last_name FROM guests ORDER BY first_name");
$rooms = mysqli_query($conn, "SELECT id, room_number, room_type, room_price FROM rooms WHERE room_status = 'Available'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Reservation</title>
    <style>
        /* Copy your existing styles */
    </style>
</head>
<body>
    <h2>Add New Reservation</h2>
    <div class="card">
        <form action="insert_reservations.php" method="POST">
            <label>Select Guest</label>
            <select name="guest_id" required>
                <option value="">-- Select Guest --</option>
                <?php while($guest = mysqli_fetch_assoc($guests)): ?>
                <option value="<?= $guest['id'] ?>">
                    <?= $guest['first_name'] . ' ' . $guest['last_name'] ?>
                </option>
                <?php endwhile; ?>
            </select>
            
            <label>Select Room</label>
            <select name="room_id" id="room_id" required>
                <option value="">-- Select Room --</option>
                <?php while($room = mysqli_fetch_assoc($rooms)): ?>
                <option value="<?= $room['id'] ?>" data-price="<?= $room['room_price'] ?>">
                    Room <?= $room['room_number'] ?> (<?= $room['room_type'] ?>) - ₱<?= $room['room_price'] ?>/night
                </option>
                <?php endwhile; ?>
            </select>
            
            <label>Check-in Date</label>
            <input type="date" name="check_in_date" id="check_in" required>
            
            <label>Check-out Date</label>
            <input type="date" name="check_out_date" id="check_out" required>
            
            <label>Number of Guests</label>
            <input type="number" name="number_of_guests" min="1" required>
            
            <label>Total Price (Auto-calculated)</label>
            <input type="text" name="total_price" id="total_price" readonly>
            
            <label>Booking Status</label>
            <select name="booking_status" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed" selected>Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            
            <button type="submit">Save Reservation</button>
        </form>
    </div>
    
    <script>
    function calculateTotal() {
        let roomSelect = document.getElementById('room_id');
        let checkIn = new Date(document.getElementById('check_in').value);
        let checkOut = new Date(document.getElementById('check_out').value);
        
        if(roomSelect.selectedIndex > 0 && checkIn && checkOut && checkOut > checkIn) {
            let price = roomSelect.options[roomSelect.selectedIndex].getAttribute('data-price');
            let days = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            document.getElementById('total_price').value = '₱' + (days * price).toFixed(2);
        }
    }
    
    document.getElementById('room_id').addEventListener('change', calculateTotal);
    document.getElementById('check_in').addEventListener('change', calculateTotal);
    document.getElementById('check_out').addEventListener('change', calculateTotal);
    </script>
</body>
</html>