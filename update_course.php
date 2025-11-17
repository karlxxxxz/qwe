<?php
include('dbcon.php');

if (isset($_POST['update_course'])) {
    $course_id = $_POST['course_id'];
    $course_name = mysqli_real_escape_string($link, $_POST['course_name']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $duration = mysqli_real_escape_string($link, $_POST['duration']);

    $query = "UPDATE courses SET 
                course_name='$course_name', 
                description='$description', 
                duration='$duration' 
              WHERE id='$course_id'";

    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        header("Location: courses.php?message=Course updated successfully!");
        exit(0);
    } else {
        die("Update Failed: " . mysqli_error($link));
    }
}
?>
