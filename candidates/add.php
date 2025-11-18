<?php
require_once __DIR__ . '/../db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $fname = mysqli_real_escape_string($conn, trim($_POST['candFName']));
    $mname = mysqli_real_escape_string($conn, trim($_POST['candMName']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['candLName']));
    $posID = (int) $_POST['posID'];
    if($fname==='' || $lname==='' || $posID<=0){
        header("Location: index.php?message=" . urlencode("All required fields must be filled."));
        exit;
    }
    $q = "INSERT INTO candidates (candFName, candMName, candLName, posID, candStat) VALUES ('$fname','$mname','$lname',$posID,'active')";
    if(mysqli_query($conn,$q)){
        header("Location: index.php?message=" . urlencode("Candidate added."));
        exit;
    } else {
        header("Location: index.php?message=" . urlencode("Insert failed: " . mysqli_error($conn)));
        exit;
    }
}
$posRes = mysqli_query($conn, "SELECT * FROM positions WHERE posStat='open' ORDER BY posName ASC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Add Candidate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container mt-4">
  <a href="index.php" class="btn btn-link">&larr; Back to Candidates</a>
  <div class="container-box mt-2">
    <h3>Add Candidate</h3>
    <form method="post" class="mt-3">
      <div class="row">
        <div class="col-md-4 mb-3"><label>First Name</label><input name="candFName" class="form-control" required></div>
        <div class="col-md-4 mb-3"><label>Middle Name</label><input name="candMName" class="form-control"></div>
        <div class="col-md-4 mb-3"><label>Last Name</label><input name="candLName" class="form-control" required></div>
      </div>
      <div class="mb-3">
        <label>Position</label>
        <select name="posID" class="form-control" required>
          <option value="">-- Select Position --</option>
          <?php while($p = mysqli_fetch_assoc($posRes)): ?>
            <option value="<?php echo $p['posID']; ?>"><?php echo htmlspecialchars($p['posName']); ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <button class="btn btn-success">Add Candidate</button>
      <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>
