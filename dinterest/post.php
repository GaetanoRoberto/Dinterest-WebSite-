<?php
    require_once 'db.php';
    require 'functions.php';
    session_start();
    /*if(!isset($_SESSION['username'])){
        header("Location:index.php");
    } else{
        $user = $_SESSION['username'];
    }*/
    $user='raf@mail.com';
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/post.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
    </head>
    <body>
        <div class='header'>            
            <?php include 'header.php' ?>
        </div>
        <div class="container">
            <?php
                if (isset($_FILES['img'])) {
                    if (empty($_FILES['img']['name'])) {
                        echo 'non hai selezionato un\' immagine';
                    } else {
                        $allowed = ['png', 'jpg', 'jpeg'];
                        $fl_name = $_FILES['img']['name'];
                        $fl_extn = strtolower(end(explode('.', $fl_name)));
                        $fl_temp = $_FILES['img']['tmp_name'];
                        $topic = $_POST['topic'];
                        if (in_array($fl_extn, $allowed)) {
                            insert_img($db, $user, $fl_extn, $fl_temp, $topic);
                        } else {
                            echo '<script type="text/javascript">
                            alert("Estensione file non corretta")</script>';
                        }
                    }
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="img" id="img">
                <br><br><br><br>
                <label for="topic">Scegli un argomento:</label>
                <select id="topic" name="topic">
                    <option value="Animali">Animali</option>
                    <option value="Bellezza">Bellezza</option>
                    <option value="Cibo">Cibo</option>
                    <option value="Film">Film</option>
                    <option value="Moda">Moda</option>
                    <option value="Sport">Sport</option>
                    <option value="Veicoli">Veicoli</option>
                    <option value="Viaggi">Viaggi</option>
                    <option value="Videogiochi">Videogiochi</option>
                </select>
                <br><br><br><br>
                <input type="submit" value="Pubblica">
            </form>
        </div>
        <div class='footer'>
            <?php include 'footer.html' ?>
        </div>  
    </body>
</html>