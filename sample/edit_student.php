<?php
include "db_connect.php";

$id = (int)$_GET['id'];

// Fetch existing student
$stmt = mysqli_prepare($conn, "SELECT id, name, email, course FROM students WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $student = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if(!$student){
            die("Student not found.");
        }



?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this student?");
        }
    </script>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST" onsubmit="return confirmUpdate();">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>

    <label>Course:</label><br>
    <input type="text" name="course" value="<?= $student['course'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
