<?php
include "db_connect.php";

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: view_student.php");
exit;
