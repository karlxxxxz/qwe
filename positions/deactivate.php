<?php
require_once __DIR__ . '/../db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deactivate'])){
    $id = (int) $_POST['posID'];
    if($id<=0){
        header("Location: index.php?message=" . urlencode("Invalid ID."));
        exit;
    }
    $q = "UPDATE positions SET posStat='closed' WHERE posID=$id";
    if(mysqli_query($conn, $q)){
        header("Location: index.php?message=" . urlencode("Position deactivated successfully!"));
        exit;
    } else {
        header("Location: index.php?message=" . urlencode("Deactivation failed: " . mysqli_error($conn)));
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
