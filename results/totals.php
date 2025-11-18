<?php
require_once __DIR__ . '/../db.php';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Totals</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../style.css"></head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark"><div class="container"><a class="navbar-brand" href="../index.php">Election Results</a></div></nav>
<div class="container mt-4">
  <h3>Election Results (Totals & Percentage)</h3>

  <?php
  $posRes = mysqli_query($conn, "SELECT * FROM positions ORDER BY posID ASC");
  while($pos = mysqli_fetch_assoc($posRes)){
    echo '<div class="container-box mb-3">';
    echo '<h5>' . htmlspecialchars($pos['posName']) . '</h5>';
    $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM votes WHERE posID=".(int)$pos['posID']))['total'];
    echo '<p class="small text-muted">Total votes: ' . (int)$total . '</p>';
    echo '<div class="table-responsive"><table class="table"><thead><tr><th>Candidate</th><th>Total Votes</th><th>%</th></tr></thead><tbody>';
    $candRes = mysqli_query($conn, "SELECT * FROM candidates WHERE posID=".(int)$pos['posID']);
    while($c = mysqli_fetch_assoc($candRes)){
      $cnt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM votes WHERE candID=".(int)$c['candID'] ))['cnt'];
      $pct = ($total==0)? 0 : ($cnt / $total) * 100;
      $name = htmlspecialchars($c['candFName'] . ' ' . ($c['candMName']? $c['candMName'].' ':'') . $c['candLName']);
      echo '<tr><td>'.$name.'</td><td>'.(int)$cnt.'</td><td>'.number_format($pct,2).'%</td></tr>';
    }
    echo '</tbody></table></div></div>';
  }
  ?>
</div>
</body>
</html>
