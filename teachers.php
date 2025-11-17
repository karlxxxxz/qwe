<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div class="box1">
    <h2>All Teachers</h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addTeacherModal">Add Teacher</button>
</div>

<table class="table table-bordered table-striped table-hover mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Role</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // ✅ Consistent with dbcon.php ($link)
        $query = "SELECT * FROM users WHERE role = 'teacher'";
        $result = mysqli_query($link, $query);

        if (!$result) {
            die("Query Failed: " . mysqli_error($link));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo ucfirst($row['role']); ?></td>
                    <td><a href="edit_teacher.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
                    <td>
                        <form action="delete_teacher.php" method="POST" class="d-inline">
                            <button type="submit" name="delete_teacher" value="<?php echo $row['id']; ?>" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<!-- ✅ Message section (black text, same as index.php) -->
<?php
if (isset($_GET['insert_msg'])) {
    echo "<h6 class='text-center text-dark'>" . $_GET['insert_msg'] . "</h6>";
}

if (isset($_GET['delete_msg'])) {
    echo "<h6 class='text-center text-dark'>" . $_GET['delete_msg'] . "</h6>";
}

if (isset($_GET['update_msg'])) {
    echo "<h6 class='text-center text-dark'>" . $_GET['update_msg'] . "</h6>";
}
?>

<!-- ✅ Add Teacher Modal -->
<form action="insert_teacher.php" method="POST">
<div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
          </div>
          <input type="hidden" name="role" value="teacher">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save_teacher" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- ✅ Bootstrap 4 JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php include('footer.php'); ?>
