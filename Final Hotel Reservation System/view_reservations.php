<!-- In view_reservations.php, update the form section -->
<?php
// Get available rooms
$rooms_query = "SELECT id, room_number, room_type, room_price FROM rooms WHERE room_status = 'Available'";
$rooms_result = mysqli_query($conn, $rooms_query);

// Get guests
$guests_query = "SELECT id, first_name, last_name FROM guests";
$guests_result = mysqli_query($conn, $guests_query);
?>

<form action="insert_reservations.php" method="POST">
    <label>Select Guest</label>
    <select name="guest_id" required>
        <option value="">Choose a guest...</option>
        <?php while ($guest = mysqli_fetch_assoc($guests_result)): ?>
            <option value="<?= $guest['id'] ?>">
                <?= $guest['first_name'] . ' ' . $guest['last_name'] ?>
            </option>
        <?php endwhile; ?>
    </select>
    
    <label>Select Room</label>
    <select name="room_id" id="room_id" required>
        <option value="">Choose a room...</option>
        <?php while ($room = mysqli_fetch_assoc($rooms_result)): ?>
            <option value="<?= $room['id'] ?>" data-price="<?= $room['room_price'] ?>">
                Room <?= $room['room_number'] ?> - <?= $room['room_type'] ?> ($<?= $room['room_price'] ?>/night)
            </option>
        <?php endwhile; ?>
    </select>
    
    <label>Check-in Date</label>
    <input type="date" name="check_in_date" id="check_in" required>
    
    <label>Check-out Date</label>
    <input type="date" name="check_out_date" id="check_out" required>
    
    <label>Number of Guests</label>
    <input type="number" name="number_of_guests" required>
    
    <label>Total Price</label>
    <input type="text" name="total_price" id="total_price" readonly>
    
    <label>Booking Status</label>
    <select name="booking_status" required>
        <option value="Pending">Pending</option>
        <option value="Confirmed">Confirmed</option>
        <option value="Cancelled">Cancelled</option>
    </select>
    
    <button type="submit">Save Reservation</button>
</form>

<script>
// Auto-calculate total price
document.getElementById('check_in').addEventListener('change', calculatePrice);
document.getElementById('check_out').addEventListener('change', calculatePrice);
document.getElementById('room_id').addEventListener('change', calculatePrice);

function calculatePrice() {
    var checkIn = new Date(document.getElementById('check_in').value);
    var checkOut = new Date(document.getElementById('check_out').value);
    var roomSelect = document.getElementById('room_id');
    var selectedOption = roomSelect.options[roomSelect.selectedIndex];
    var roomPrice = parseFloat(selectedOption.getAttribute('data-price'));
    
    if (checkIn && checkOut && roomPrice) {
        var timeDiff = checkOut - checkIn;
        var days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        var total = days * roomPrice;
        document.getElementById('total_price').value = total.toFixed(2);
    }
}
</script>
