<?php

    $servername = "localhost:3306"; 
    $db_username = "root"; 
    $db_password = "DSKR424zewae4:$24;"; 
    $dbname = "innovadb"; 

    
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if($conn->connect_error)
    {
        die("Failed to connect to database!");
    }

