    <?php
    include "db_connect.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO students (name, email, course) VALUES (?, ?, ?)"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $_POST['name'],
            $_POST['email'],
            $_POST['course']
        );

        if(mysqli_stmt_execute($stmt)){
            echo "Student inserted successfully";
        }else{
            echo "Insert Failed";
        }
            


        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: view_student.php");
        exit;
    }
    ?>