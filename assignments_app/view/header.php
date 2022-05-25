<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Assignment Tracker</title>
    <link rel="stylesheet" href="view/css/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    
 <main class="main">
 <section>
        <nav>
            <ul>
                <?php
                    if(isset($_SESSION["userid"])){    
                ?>
                    <li><a href="#"><?php echo $_SESSION["useruid"]?></a></li>
                    <li><a href="index.php?action=logout">LOGOUT</a></li>
                <?php
                    } else {
                ?>
                
                <?php
                    }
                ?>
            </ul>
        </nav>
    </section>