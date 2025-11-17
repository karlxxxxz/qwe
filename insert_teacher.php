<?php
include('dbcon.php');

if (isset($_POST['save_teacher'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $role = $_POST['role']; 

    
    $query = "INSERT INTO users (first_name, last_name, age, role) 
              VALUES ('$first_name', '$last_name', '$age', '$role')";

    $result = mysqli_query($link, $query);

    if ($result) {
        header("Location: teachers.php?insert_msg=Teacher added successfully");
        exit();
    } else {
        die("Query Failed: " . mysqli_error($link));
    }
}
?>
