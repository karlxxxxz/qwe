<?php
require_once __DIR__ . '/../db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $fname = mysqli_real_escape_string($conn, trim($_POST['voterFName']));
    $mname = mysqli_real_escape_string($conn, trim($_POST['voterMName']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['voterLName']));
    $pass = $_POST['voterPass'];
    if($fname==='' || $lname==='' || $pass===''){ header("Location: index.php?message=" . urlencode("Required fields.")); exit;}
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $q = "INSERT INTO voters (voterPass, voterFName, voterMName, voterLName, voterStat, voted) VALUES ('".$hash."','".$fname."','".$mname."','".$lname."','active','N')";
    if(mysqli_query($conn,$q)){ header("Location: index.php?message=" . urlencode("Voter added.")); exit; } else { header("Location: index.php?message=" . urlencode("Failed: " . mysqli_error($conn))); exit;}
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Voter</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container mt-4">
  <a href="index.php" class="btn btn-link">&larr; Back</a>
  <div class="container-box mt-2">
    <h3>Add Voter</h3>
    <form method="post" class="mt-3">
      <div class="row">
        <div class="col-md-4 mb-3"><label>First Name</label><input name="voterFName" class="form-control" required></div>
        <div class="col-md-4 mb-3"><label>Middle Name</label><input name="voterMName" class="form-control"></div>
        <div class="col-md-4 mb-3"><label>Last Name</label><input name="voterLName" class="form-control" required></div>
      </div>
      <div class="mb-3"><label>Password</label><input type="password" name="voterPass" class="form-control" required></div>
      <button class="btn btn-success">Add Voter</button>
      <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>
