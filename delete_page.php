<?php include ('dbcon.php'); ?>

<?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM students WHERE id = $id";
        $result = mysqli_query($link, $query);

        if(!$result){
            die("Query Failed: " . mysqli_error($link));    
        } else {
            header("Location: index.php?message=Deleted Successfully!");
            exit();
        }
    } else {
        header("Location: index.php?message=No ID provided for deletion.");
        exit();
    }