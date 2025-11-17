<?php
include('dbcon.php');

if (isset($_POST['delete_course'])) {
    $course_id = $_POST['delete_course'];

    $query = "DELETE FROM courses WHERE id='$course_id'";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        header("Location: courses.php?message=Course deleted successfully!");
        exit(0);
    } else {
        die("Delete Failed: " . mysqli_error($link));
    }
}
?>
