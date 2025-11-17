<?php
include 'dbcon.php';

if(isset($_POST['add_students'])){
    
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];

    if($f_name == "" || empty($f_name)){
        header('location:index.php?message=First Name is required!');
        exit();
    } else {
        $query = "INSERT INTO students (first_name, last_name, age) VALUES ('$f_name', '$l_name', '$age')";
        $result = mysqli_query($link, $query);
    
        if(!$result){
            die("Query Failed: " . mysqli_error($link));
        } else {
            header('location:index.php?insert_msg=Data Inserted Successfully!');
            exit();
        }
    }
}
?>
