<?php require_once __DIR__ . '/../db.php'; ?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Voters</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark"><div class="container"><a class="navbar-brand" href="../index.php">Election System</a></div></nav>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Voters</h2>
    <a href="add.php" class="btn btn-primary">Add Voter</a>
  </div>

  <?php if(isset($_GET['message'])): ?><div class="alert alert-centered"><?php echo htmlspecialchars($_GET['message']); ?></div><?php endif; ?>

  <div class="container-box">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr class="text-center"><th>voterID</th><th class="text-start">Full Name</th><th>Status</th><th>Voted</th><th>Update</th><th>Deactivate</th></tr></thead>
        <tbody>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM voters ORDER BY voterID DESC");
        if($res && mysqli_num_rows($res)>0){
          while($r = mysqli_fetch_assoc($res)){
            echo '<tr class="text-center">';
            echo '<td>' . $r['voterID'] . '</td>';
            echo '<td class="text-start">' . htmlspecialchars($r['voterFName'] . ' ' . ($r['voterMName']? $r['voterMName'].' ':'') . $r['voterLName']) . '</td>';
            echo '<td>' . $r['voterStat'] . '</td>';
            echo '<td>' . $r['voted'] . '</td>';
            echo '<td><a class="btn btn-sm btn-success" href="edit.php?id=' . $r['voterID'] . '">Update</a></td>';
            echo '<td><form method="post" action="deactivate.php" onsubmit="return confirm(\'Deactivate voter?\');"><input type="hidden" name="voterID" value="' . $r['voterID'] . '"><button name="deactivate" class="btn btn-sm btn-warning">Deactivate</button></form></td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="6" class="text-center">No voters found.</td></tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
