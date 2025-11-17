<?php

    define('HOSTNAME', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');          
    define('DATABASE', 'crud_operations');
    define('PORT', 3307); 

    $link = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    // else{    