<?php
require_once __DIR__ . '/../db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_candidate'])){
    $id = (int) $_POST['candID'];
    $fname = mysqli_real_escape_string($conn, trim($_POST['candFName']));
    $mname = mysqli_real_escape_string($conn, trim($_POST['candMName']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['candLName']));
    $posID = (int) $_POST['posID'];
    $stat = ($_POST['candStat'] === 'inactive') ? 'inactive' : 'active';

    if($id<=0 || $fname==='' || $lname==='' || $posID<=0){
        header("Location: index.php?message=" . urlencode("Invalid input."));
        exit;
    }
    $q = "UPDATE candidates SET candFName='$fname', candMName='$mname', candLName='$lname', posID=$posID, candStat='$stat' WHERE candID=$id";
    if(mysqli_query($conn,$q)){
        header("Location: index.php?message=" . urlencode("Candidate updated."));
        exit;
    } else {
        header("Location: index.php?message=" . urlencode("Update failed: " . mysqli_error($conn)));
        exit;
    }
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if($id<=0){ header("Location: index.php?message=" . urlencode("No ID.")); exit;}
$res = mysqli_query($conn, "SELECT * FROM candidates WHERE candID=$id");
if(!$res || mysqli_num_rows($res)==0){ header("Location: index.php?message=" . urlencode("Candidate not found.")); exit; }
$row = mysqli_fetch_assoc($res);
$posRes = mysqli_query($conn, "SELECT * FROM positions ORDER BY posName ASC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Candidate</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container mt-4">
  <a href="index.php" class="btn btn-link">&larr; Back</a>
  <div class="container-box mt-2">
    <h3>Edit Candidate</h3>
    <form method="post" class="mt-3">
      <input type="hidden" name="candID" value="<?php echo $row['candID']; ?>">
      <div class="row">
        <div class="col-md-4 mb-3"><label>First Name</label><input name="candFName" class="form-control" value="<?php echo htmlspecialchars($row['candFName']); ?>" required></div>
        <div class="col-md-4 mb-3"><label>Middle Name</label><input name="candMName" class="form-control" value="<?php echo htmlspecialchars($row['candMName']); ?>"></div>
        <div class="col-md-4 mb-3"><label>Last Name</label><input name="candLName" class="form-control" value="<?php echo htmlspecialchars($row['candLName']); ?>" required></div>
      </div>
      <div class="mb-3">
        <label>Position</label>
        <select name="posID" class="form-control" required>
          <?php while($p = mysqli_fetch_assoc($posRes)): ?>
            <option value="<?php echo $p['posID']; ?>" <?php echo ($p['posID']==$row['posID'])?'selected':''; ?>><?php echo htmlspecialchars($p['posName']); ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="mb-3">
        <label>Status</label>
        <select name="candStat" class="form-control" required>
          <option value="active" <?php echo ($row['candStat']=='active')?'selected':''; ?>>active</option>
          <option value="inactive" <?php echo ($row['candStat']=='inactive')?'selected':''; ?>>inactive</option>
        </select>
      </div>
      <button name="update_candidate" class="btn btn-success">Update</button>
      <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>
