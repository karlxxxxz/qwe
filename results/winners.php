<?php
require_once __DIR__ . '/../db.php';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Winners</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../style.css"></head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark"><div class="container"><a class="navbar-brand" href="../index.php">Winners</a></div></nav>
<div class="container mt-4">
  <h3>Election Winners</h3>
  <div class="container-box">
    <table class="table">
      <thead><tr><th>Position</th><th>Winner</th><th>Total Votes</th></tr></thead>
      <tbody>
      <?php
      $posRes = mysqli_query($conn, "SELECT * FROM positions ORDER BY posID ASC");
      while($pos = mysqli_fetch_assoc($posRes)){
        $q = mysqli_query($conn, "
          SELECT c.candFName, c.candMName, c.candLName, COUNT(v.voteID) AS votes
          FROM candidates c
          LEFT JOIN votes v ON c.candID = v.candID
          WHERE c.posID = ".(int)$pos['posID']."
          GROUP BY c.candID
          ORDER BY votes DESC
          LIMIT 1
        ");
        if($q && mysqli_num_rows($q)>0){
          $w = mysqli_fetch_assoc($q);
          $name = htmlspecialchars($w['candFName'] . ' ' . ($w['candMName']? $w['candMName'].' ':'') . $w['candLName']);
          $votes = (int)$w['votes'];
        } else { $name = 'No candidate'; $votes = 0; }
        echo '<tr><td>'.htmlspecialchars($pos['posName']).'</td><td>'.$name.'</td><td>'.$votes.'</td></tr>';
      }
      ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
