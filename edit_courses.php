<?php
include('dbcon.php');

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $query = "SELECT * FROM courses WHERE id='$course_id'";
    $query_run = mysqli_query($link, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $course = mysqli_fetch_array($query_run);
    } else {
        echo "No course found!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Edit Course</h4>
        </div>
        <div class="card-body">
            <form action="update_course.php" method="POST">
                <input type="hidden" name="course_id" value="<?= $course['id']; ?>">

                <div class="mb-3">
                    <label>Course Name</label>
                    <input type="text" name="course_name" value="<?= $course['course_name']; ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required><?= $course['description']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Duration</label>
                    <input type="text" name="duration" value="<?= $course['duration']; ?>" class="form-control" required>
                </div>

                <button type="submit" name="update_course" class="btn btn-primary">Update</button>
                <a href="courses.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
