<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE guests SET first_name=?, last_name=?, email=?, phone=?, address=? WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['id']
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_guests.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

if (isset($_GET['id'])) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM guests WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $guest = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Guest</title>
   <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this guest?");
        }
    </script>
</head>
<body>
    <h2>Edit Guest</h2>
    <div class="card">
        <form method="POST" onsubmit="return confirmUpdate();">
            <input type="hidden" name="id" value="<?= $guest['id'] ?>">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= $guest['first_name'] ?>" required>

            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= $guest['last_name'] ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= $guest['email'] ?>" required>

            <label>Phone</label>
            <input type="text" name="phone" value="<?= $guest['phone'] ?>" required>

            <label>Address</label>
            <input type="text" name="address" value="<?= $guest['address'] ?>" required>

            <button type="submit">Update Guest</button>
        </form>
    </div>
</body>
</html>
