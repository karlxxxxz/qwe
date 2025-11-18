<?php
session_start();
require_once __DIR__ . '/../db.php';
if(!isset($_SESSION['voterID'])){ header("Location: login.php"); exit; }
$voterID = (int) $_SESSION['voterID'];

// prevent opening if already voted overall? We rely on per position but also mark voted=Y after submit
$resV = mysqli_query($conn, "SELECT voted FROM voters WHERE voterID=$voterID");
$rV = mysqli_fetch_assoc($resV);
if($rV['voted'] === 'Y'){ echo "You already voted."; exit; }

// fetch open positions and candidates
$posRes = mysqli_query($conn, "SELECT * FROM positions WHERE posStat='open' ORDER BY posID ASC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Vote</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container mt-4">
  <a href="login.php" class="btn btn-link">&larr; Logout</a>
  <div class="container-box mt-2">
    <h3>Cast Your Vote</h3>
    <form method="post" action="submit_vote.php">
    <?php while($pos = mysqli_fetch_assoc($posRes)): ?>
      <div class="mb-4">
        <h5><?php echo htmlspecialchars($pos['posName']); ?> <small class="text-muted">(Choose one)</small></h5>
        <?php
          $candRes = mysqli_query($conn, "SELECT * FROM candidates WHERE posID=" . (int)$pos['posID'] . " AND candStat='active' ORDER BY candLName ASC");
          if($candRes && mysqli_num_rows($candRes)>0){
            while($c = mysqli_fetch_assoc($candRes)){
              $label = htmlspecialchars($c['candFName'] . ' ' . ($c['candMName']? $c['candMName'].' ':'') . $c['candLName']);
              echo '<div class="form-check"><input class="form-check-input" type="radio" name="pos_'.$pos['posID'].'" value="'.$c['candID'].'" id="c'.$c['candID'].'"><label class="form-check-label" for="c'.$c['candID'].'">'.$label.'</label></div>';
            }
          } else {
            echo '<p class="text-muted">No candidates for this position.</p>';
          }
        ?>
      </div>
    <?php endwhile; ?>
      <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">Submit Vote</button>
        <a class="btn btn-secondary" href="../index.php">Cancel</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
