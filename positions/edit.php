<?php
require_once __DIR__ . '/../db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_position'])){
    $id = (int) $_POST['posID'];
    $posName = mysqli_real_escape_string($conn, trim($_POST['posName']));
    $num = (int) $_POST['numOfPositions'];
    $stat = ($_POST['posStat'] === 'closed') ? 'closed' : 'open';
    if($id<=0 || $posName===''){
        header("Location: index.php?message=" . urlencode("Invalid input."));
        exit;
    }
    $q = "UPDATE positions SET posName='$posName', numOfPositions=$num, posStat='$stat' WHERE posID=$id";
    if(mysqli_query($conn,$q)){
        header("Location: index.php?message=" . urlencode("Position updated successfully!"));
        exit;
    } else {
        header("Location: index.php?message=" . urlencode("Update failed: " . mysqli_error($conn)));
        exit;
    }
}

// GET part
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if($id<=0){
    header("Location: index.php?message=" . urlencode("No ID provided."));
    exit;
}
$res = mysqli_query($conn, "SELECT * FROM positions WHERE posID=$id");
if(!$res || mysqli_num_rows($res)==0){
    header("Location: index.php?message=" . urlencode("Position not found."));
    exit;
}
$row = mysqli_fetch_assoc($res);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Edit Position</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container mt-4">
  <a href="index.php" class="btn btn-link">&larr; Back</a>
  <div class="container-box mt-2">
    <h3>Edit Position</h3>
    <form method="post" class="mt-3">
      <input type="hidden" name="posID" value="<?php echo htmlspecialchars($row['posID']); ?>">
      <div class="mb-3"><label>Position Name</label><input class="form-control" name="posName" value="<?php echo htmlspecialchars($row['posName']); ?>" required></div>
      <div class="mb-3"><label>Number of Vacancies</label><input type="number" class="form-control" name="numOfPositions" min="1" value="<?php echo htmlspecialchars($row['numOfPositions']); ?>" required></div>
      <div class="mb-3"><label>Status</label>
        <select name="posStat" class="form-control" required>
          <option value="open" <?php echo ($row['posStat']=='open')?'selected':''; ?>>open</option>
          <option value="closed" <?php echo ($row['posStat']=='closed')?'selected':''; ?>>closed</option>
        </select>
      </div>
      <button name="update_position" class="btn btn-success">Update</button>
      <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>
