<?php
session_start();
require_once __DIR__ . '/../db.php';
$err = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = (int) $_POST['voterID'];
    $pass = $_POST['voterPass'] ?? '';
    
    if($id<=0 || $pass===''){ 
        $err = "Provide ID and password."; 
    } else {
        // --- FIX: Using prepared statement to securely fetch voter data ---
        $q = "SELECT voterID, voterPass, voterStat, voted FROM voters WHERE voterID=?";
        $stmt = mysqli_prepare($conn, $q);

        if ($stmt === false) {
            $err = "Database error during preparation: " . mysqli_error($conn);
        } else {
            // 'i' means the parameter is an integer
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if($res && mysqli_num_rows($res)==1){
                $row = mysqli_fetch_assoc($res);

                // Start standard validation checks
                if($row['voterStat'] !== 'active'){ 
                    $err = "Voter not active."; 
                } elseif($row['voted'] === 'Y'){ 
                    $err = "You already voted."; 
                } elseif(password_verify($pass, $row['voterPass'])){
                    $_SESSION['voterID'] = $row['voterID'];
                    header("Location: vote.php");
                    exit;
                } else { 
                    $err = "Invalid credentials."; 
                }
            } else { 
                $err = "Voter not found."; 
            }
            mysqli_stmt_close($stmt);
        }
        // ---------------------------------------------------------------------
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Voter Login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../style.css"></head>
<body>
<div class="container mt-5">
    <div class="mx-auto" style="max-width:480px;">
        <div class="container-box">
            <h3 class="mb-3">Voter Login</h3>
            <?php if($err): ?><div class="alert alert-danger"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>
            <form method="post">
                <div class="mb-3"><label>Voter ID</label><input type="number" name="voterID" class="form-control" required></div>
                <div class="mb-3"><label>Password</label><input type="password" name="voterPass" class="form-control" required></div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary">Login</button>
                    <a class="btn btn-secondary" href="../index.php">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>