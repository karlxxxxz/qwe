<?php
require_once __DIR__ . '/../db.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Candidates</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="../index.php">Election System</a>
  </div>
</nav>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Candidates</h2>
    <a href="add.php" class="btn btn-primary">Add Candidate</a>
  </div>

  <?php if(isset($_GET['message'])): ?>
    <div class="alert alert-centered"><?php echo htmlspecialchars($_GET['message']); ?></div>
  <?php endif; ?>

  <div class="container-box">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr class="text-center">
            <th>candID</th>
            <th class="text-start">Full Name</th>
            <th>Position</th>
            <th>Status</th>
            <th>Update</th>
            <th>Deactivate</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $q = "SELECT c.*, p.posName FROM candidates c JOIN positions p ON c.posID = p.posID ORDER BY c.candID DESC";
        $res = mysqli_query($conn, $q);
        if ($res && mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            echo '<tr class="text-center">';
            echo '<td>' . htmlspecialchars($row['candID']) . '</td>';
            echo '<td class="text-start">' . htmlspecialchars($row['candFName'] . ' ' . ($row['candMName']? $row['candMName'].' ':'') . $row['candLName']) . '</td>';
            echo '<td>' . htmlspecialchars($row['posName']) . '</td>';
            echo '<td>' . htmlspecialchars($row['candStat']) . '</td>';
            echo '<td><a class="btn btn-sm btn-success" href="edit.php?id=' . urlencode($row['candID']) . '">Update</a></td>';
            echo '<td>
                    <form method="post" action="deactivate.php" onsubmit="return confirm(\'Deactivate this candidate?\');">
                      <input type="hidden" name="candID" value="' . htmlspecialchars($row['candID']) . '">
                      <button type="submit" name="deactivate" class="btn btn-sm btn-warning">Deactivate</button>
                    </form>
                  </td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="6" class="text-center">No candidates found.</td></tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
