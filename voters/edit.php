<?php
require_once __DIR__ . '/../db.php';
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update_voter'])){
    $id = (int) $_POST['voterID'];
    $fname = mysqli_real_escape_string($conn, trim($_POST['voterFName']));
    $mname = mysqli_real_escape_string($conn, trim($_POST['voterMName']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['voterLName']));
    $stat = ($_POST['voterStat']==='inactive') ? 'inactive' : 'active';
    if($id<=0 || $fname==='' || $lname===''){ header("Location: index.php?message=" . urlencode("Invalid data.")); exit; }
    $q = "UPDATE voters SET voterFName='$fname', voterMName='$mname', voterLName='$lname', voterStat='$stat' WHERE voterID=$id";
    if(mysqli_query($conn,$q)){ header("Location: index.php?message=" . urlencode("Voter updated.")); exit; } else { header("Location: index.php?message=" . urlencode("Update failed: " . mysqli_error($conn))); exit; }
}
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if($id<=0){ header("Location: index.php?message=" . urlencode("No ID.")); exit; }
$res = mysqli_query($conn, "SELECT * FROM voters WHERE voterID=$id");
if(!$res || mysqli_num_rows($res)==0){ header("Location: index.php?message=" . urlencode("Not found.")); exit; }
$row = mysqli_fetch_assoc($res);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Voter</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container mt-4">
  <a href="index.php" class="btn btn-link">&larr; Back</a>
  <div class="container-box mt-2">
    <h3>Edit Voter</h3>
    <form method="post" class="mt-3">
      <input type="hidden" name="voterID" value="<?php echo $row['voterID']; ?>">
      <div class="row">
        <div class="col-md-4 mb-3"><label>First Name</label><input name="voterFName" class="form-control" value="<?php echo htmlspecialchars($row['voterFName']); ?>" required></div>
        <div class="col-md-4 mb-3"><label>Middle Name</label><input name="voterMName" class="form-control" value="<?php echo htmlspecialchars($row['voterMName']); ?>"></div>
        <div class="col-md-4 mb-3"><label>Last Name</label><input name="voterLName" class="form-control" value="<?php echo htmlspecialchars($row['voterLName']); ?>" required></div>
      </div>
      <div class="mb-3"><label>Status</label><select name="voterStat" class="form-control"><option value="active" <?php echo ($row['voterStat']=='active')?'selected':''; ?>>active</option><option value="inactive" <?php echo ($row['voterStat']=='inactive')?'selected':''; ?>>inactive</option></select></div>
      <button name="update_voter" class="btn btn-success">Update</button>
      <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>
