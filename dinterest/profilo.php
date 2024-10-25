<?php
    session_start();
    require_once 'db.php';
    require 'functions.php';

    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
    $user = $_SESSION['username'];
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/profilo.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
    </head>
    <body>
        <div class="container">
            <div class='header'>            
                <?php include 'header.php' ?>
            </div>
            <h2><?php echo get_nome($db, $user);?></h2>
            <br><br>
            <div id="bottoni">
                <form name="logout" id="logout" action="logout.php" method="post">
                    <button id="logout_btn" type="submit">Logout</button>
                </form>
                <p>
                    <button id="save_btn" style="background-color:salmon">Immagini salvate</button>
                    <button id="post_btn">Postate</button>
                </p>
            </div>
            <br><br>
            <div class="row" id="foto_salvate">
                <?php
                    saved_imgs($db, $user);
                ?>
            </div>
            <div class="row" id="foto_postate" style="display: none;">
                <?php
                    post_imgs($db, $user);
                ?>
            </div>
            <script type="text/javascript">
                document.getElementById("save_btn").onclick = function show_save(){
                    document.getElementById("foto_salvate").style.removeProperty("display");
                    document.getElementById("foto_postate").style.setProperty("display","none");

                }
                document.getElementById("post_btn").onclick = function show_post(){
                    document.getElementById("foto_postate").style.removeProperty("display");
                    document.getElementById("save_btn").style.removeProperty("background-color");
                    document.getElementById("foto_salvate").style.setProperty("display","none");
                }
                const save_btn = document.getElementById('save_btn');
                const post_btn = document.getElementById('post_btn');
                save_btn.addEventListener('click',function onClick(){
                    save_btn.style.backgroundColor = 'salmon';
                    post_btn.style.backgroundColor = 'white';  
                });
                post_btn.addEventListener('click',function onClick(){
                    post_btn.style.backgroundColor = 'salmon';
                    save_btn.style.backgroundColor = 'white';
                });
            </script>
            <div class='footer'>
                <?php include 'footer.html' ?>
            </div> 
        </div>
    </body>
</html>