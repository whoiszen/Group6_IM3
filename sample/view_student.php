<?php
include "db_connect.php";

$sql = "SELECT * FROM students ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this student?");
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
   <div class="card">
    <form action="insert_student.php" method="POST">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Course</label>
        <input type="text" name="course" required>

        <button type="submit">Save Student</button>
    </form>
</div>
<h2>Student List</h2>

<div class="table-card">
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Actions</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['course'] ?></td>
    
    <td class="action-links">
        <a href="edit_student.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete_student.php?id=
        <?= $row['id'] ?>" 
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
