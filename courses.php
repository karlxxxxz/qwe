<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div class="box1">
    <h2>All Courses</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addCourseModal">Add Course</button>
</div>

<?php
if (isset($_GET['message'])) {
    echo "
    <div class='text-center mt-3'>
        <p style='color: black; font-weight: 600;'>" . htmlspecialchars($_GET['message']) . "</p>
    </div>
    ";
}
?>

<table class="table table-bordered table-striped table-hover mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM courses";
        $result = mysqli_query($link, $query);

        if (!$result) {
            die("Query Failed: " . mysqli_error($link));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['duration']; ?></td>
                    <td>
                        <a href="edit_course.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Update</a>
                    </td>
                    <td>
                        <form action="delete_course.php" method="POST" class="d-inline">
                            <button type="submit" name="delete_course" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<form action="insert_course.php" method="POST">
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>Course Name</label>
            <input type="text" name="course_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" class="form-control" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save_course" class="btn btn-success">Add Course</button>
      </div>
    </div>
  </div>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php include('footer.php'); ?>
