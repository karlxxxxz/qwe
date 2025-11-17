<?php
include('header.php');
include('dbcon.php');

// ✅ Get teacher data by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $age = $row['age'];
        $role = $row['role'];
    } else {
        echo "<h5 class='text-danger text-center'>Teacher not found.</h5>";
        exit;
    }
}

// ✅ Update teacher record
if (isset($_POST['update_teacher'])) {
    $update_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];

    $update_query = "UPDATE users SET first_name='$first_name', last_name='$last_name', age='$age' WHERE id=$update_id";
    $run_update = mysqli_query($link, $update_query);

    if ($run_update) {
        header("Location: teachers.php?insert_msg=Teacher Updated Successfully!");
        exit;
    } else {
        echo "<h6 class='text-danger text-center'>Update failed. Please try again.</h6>";
    }
}
?>

<!-- ✅ Edit Teacher Form -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Edit Teacher</h4>
        </div>
        <div class="card-body">
            <form action="edit_teacher.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" required>
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" value="<?php echo $age; ?>" required>
                </div>

                <button type="submit" name="update_teacher" class="btn btn-success">Update</button>
                <a href="teachers.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
