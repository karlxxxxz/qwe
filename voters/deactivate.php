<?php
require_once __DIR__ . '/../db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deactivate'])){
    $id = (int) $_POST['voterID'];
    if($id<=0){ header("Location: index.php?message=" . urlencode("Invalid ID.")); exit; }
    $q = "UPDATE voters SET voterStat='inactive' WHERE voterID=$id";
    if(mysqli_query($conn,$q)){ header("Location: index.php?message=" . urlencode("Voter deactivated.")); exit; } else { header("Location: index.php?message=" . urlencode("Failed: " . mysqli_error($conn))); exit; }
} else { header("Location: index.php"); exit; }
