<?php include ('header.php'); ?>
<?php include ('dbcon.php'); ?>

<?php   

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($link));    
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<?php   

if (isset($_POST['update_students'])) {

    if (isset($_GET['id_new'])) {
        $idnew = $_GET['id_new'];
    }

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];

    $query = "UPDATE students SET first_name = '$f_name', last_name = '$l_name', age = '$age' WHERE id = '$idnew'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($link));    
    } else {
     
        header("Location: index.php?update_msg=Updated Successfully!");
        exit();
    }
}
?>

<form action="update_page_1.php?id_new=<?php echo $id; ?>" method="post">
  <div class="form-group">
    <label for="f_name">First Name</label>
    <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>">
  </div>
  <div class="form-group">
    <label for="l_name">Last Name</label>
    <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" name="age" class="form-control" value="<?php echo $row['age']; ?>">
  </div>
  <input type="submit" class="btn btn-success" name="update_students" value="UPDATE">
  <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include ('footer.php'); ?>
