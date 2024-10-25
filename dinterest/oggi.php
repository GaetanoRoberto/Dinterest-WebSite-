<?php
    require_once 'db.php';
    require 'functions.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/responsive.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
    </head>
    <body>
        <div class="container"> 
            <div class='header'>            
                <?php include 'header.php' ?>
            </div>
            <?php
                $data = date("Y/m/d");
            ?>
            <h3><?php echo $data ?></h3>
            <h1>Prendi ispirazione</h1> 
            <div class="row">
                <?php
                    show_today($db);
                ?>
            </div>
            <div class='footer'>
                <?php include 'footer.html' ?>
            </div>  
        </div>
    </body>
</html>