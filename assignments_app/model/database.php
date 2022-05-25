<?php
    //dns to data source name, czyli nasza baza danych
    $dsn = 'mysql:host=localhost;dbname=assignment_tracker';
    $username = '****';
    $password = '******';

    try{
        $db = new PDO($dsn, $username,$password);
    } catch (PDOException $e){
        $error = "Database error: ";
        $error .= $e->getMessage();
        include('view/error.php');
        exit();
    }
