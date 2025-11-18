<?php
require_once __DIR__ . '/../db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $posName = mysqli_real_escape_string($conn, trim($_POST['posName']));
    $num = (int) $_POST['numOfPositions'];
    if($posName === ''){
        header("Location: index.php?message=" . urlencode("Position name required."));
        exit;
    }
    $q = "INSERT INTO positions (posName, numOfPositions, posStat) VALUES ('$posName', $num, 'open')";
    if(mysqli_query($conn, $q)){
        header("Location: index.php?message=" . urlencode("Position added successfully!"));
        exit;
    } else {
        header("Location: index.php?message=" . urlencode("Insert failed: " . mysqli_error($conn)));
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Add Position</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container mt-4">
  <a href="index.php" class="btn btn-link">&larr; Back</a>
  <div class="container-box mt-2">
    <h3>Add Position</h3>
    <form method="post" class="mt-3">
      <div class="mb-3"><label>Position Name</label><input class="form-control" name="posName" required></div>
      <div class="mb-3"><label>Number of Vacancies</label><input type="number" class="form-control" name="numOfPositions" min="1" value="1" required></div>
      <button class="btn btn-success">Add Position</button>
      <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>
