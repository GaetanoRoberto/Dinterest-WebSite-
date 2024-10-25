<?php
	session_start();
	require_once 'functions.php';
    require 'db.php';
    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
    $user = $_SESSION['username'];
?>	

<html>
    <head>
        <link rel="stylesheet" href="styles/responsive.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
    </head>
    <body>
        <div class="contanier">
            <div class='header'>            
                <?php include 'header.php' ?>
            </div>
            <h1>Il tuo feed</h1>
            <div class="row">
                <?php
                    display_foto($db, $user);
                ?>
            </div>
            <div class='footer'>
                <?php include 'footer.html' ?>
            </div>    
        </div>
    </body>
</html>