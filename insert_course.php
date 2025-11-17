<?php
include('dbcon.php');

if (isset($_POST['save_course'])) {
    $course_name = mysqli_real_escape_string($link, $_POST['course_name']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $duration = mysqli_real_escape_string($link, $_POST['duration']);


    $query = "INSERT INTO courses (course_name, description, duration) 
              VALUES ('$course_name', '$description', '$duration')";
    $result = mysqli_query($link, $query);

    if ($result) {
        header("Location: courses.php?message=Course added successfully!");
        exit(0);
    } else {
        die("Query Failed: " . mysqli_error($link));
    }
} else {
    header("Location: courses.php?message=Invalid Request");
    exit(0);
}
?>
