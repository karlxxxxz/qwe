<?php
session_start();
require_once __DIR__ . '/../db.php';
if(!isset($_SESSION['voterID'])){ header("Location: login.php"); exit; }
$voterID = (int) $_SESSION['voterID'];

// ensure voter active and not already voted
$resV = mysqli_query($conn, "SELECT voterStat, voted FROM voters WHERE voterID=$voterID");
if(!$resV || mysqli_num_rows($resV)==0){ die("Voter not found."); }
$rV = mysqli_fetch_assoc($resV);
if($rV['voterStat'] !== 'active'){ die("Voter not active."); }
if($rV['voted'] === 'Y'){ die("You already voted."); }

// iterate POST keys like pos_1 => candID
$inserted = 0;
foreach($_POST as $key=>$val){
    if(str_starts_with($key, 'pos_')){
        $posID = (int) substr($key,4);
        $candID = (int) $val;
        if($posID>0 && $candID>0){
            // insert vote
            $q = "INSERT INTO votes (posID, voterID, candID) VALUES ($posID, $voterID, $candID)";
            if(mysqli_query($conn,$q)) $inserted++;
        }
    }
}

// mark voter as voted if at least one vote recorded
if($inserted>0){
    mysqli_query($conn, "UPDATE voters SET voted='Y' WHERE voterID=$voterID");
    // logout voter session
    unset($_SESSION['voterID']);
    session_destroy();
    header("Location: login.php?msg=" . urlencode("Thank you! Your vote was recorded."));
    exit;
} else {
    header("Location: vote.php?msg=" . urlencode("No votes selected."));
    exit;
}
