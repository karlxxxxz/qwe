<?php include 'db.php'; 

function get_count($conn, $sql) {
    $r = mysqli_query($conn, $sql);
    if(!$r) return 0;
    $row = mysqli_fetch_row($r);
    return (int)$row[0];
}
$positions_count  = get_count($conn, "SELECT COUNT(*) FROM positions");
$candidates_count = get_count($conn, "SELECT COUNT(*) FROM candidates");
$voters_count     = get_count($conn, "SELECT COUNT(*) FROM voters");
$votes_count      = get_count($conn, "SELECT COUNT(*) FROM votes");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Election System Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Election System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="positions/index.php">Positions</a></li>
        <li class="nav-item"><a class="nav-link" href="candidates/index.php">Candidates</a></li>
        <li class="nav-item"><a class="nav-link" href="voters/index.php">Voters</a></li>
        <li class="nav-item"><a class="nav-link" href="voting/login.php">Voting</a></li>
        <li class="nav-item"><a class="nav-link" href="results/totals.php">Results</a></li>
        <li class="nav-item"><a class="nav-link" href="results/winners.php">Winners</a></li>
      </ul>
    </div>
  </div>
</nav>

<header class="py-4">
  <div class="container">
    <div class="container-box d-flex flex-column flex-md-row justify-content-between align-items-start">
      <div>
        <h2>Admin Dashboard</h2>
        <p class="text-muted">Manage positions, candidates, voters and run elections.</p>
      </div>
      <div class="d-flex gap-2">
        <a class="btn btn-primary" href="positions/index.php">Positions</a>
        <a class="btn btn-primary" href="candidates/index.php">Candidates</a>
        <a class="btn btn-primary" href="voters/index.php">Voters</a>
      </div>
    </div>
  </div>
</header>

<main class="py-4">
  <div class="container">
    <div class="row g-3">
      <div class="col-md-3">
        <div class="card container-box text-center">
          <h6 class="text-uppercase small">Positions</h6>
          <h3 class="fw-bold"><?php echo $positions_count; ?></h3>
          <a href="positions/index.php" class="btn btn-sm btn-outline-primary">Manage</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card container-box text-center">
          <h6 class="text-uppercase small">Candidates</h6>
          <h3 class="fw-bold"><?php echo $candidates_count; ?></h3>
          <a href="candidates/index.php" class="btn btn-sm btn-outline-primary">Manage</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card container-box text-center">
          <h6 class="text-uppercase small">Voters</h6>
          <h3 class="fw-bold"><?php echo $voters_count; ?></h3>
          <a href="voters/index.php" class="btn btn-sm btn-outline-primary">Manage</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card container-box text-center">
          <h6 class="text-uppercase small">Votes</h6>
          <h3 class="fw-bold"><?php echo $votes_count; ?></h3>
          <a href="results/totals.php" class="btn btn-sm btn-outline-primary">View</a>
        </div>
      </div>
    </div>
  </div>
</main>

<footer class="py-3">
  <div class="container text-center text-muted">
    &copy; <?php echo date('Y'); ?> Election System
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>