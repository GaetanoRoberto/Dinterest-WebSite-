<?php
    session_start();
	require_once 'functions.php';
    require 'db.php';
    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
    $user = $_SESSION['username'];
    $path = $_GET['path'];
    $id_foto = $_GET['id'];
    $saved=save_unsave($db,$user,$id_foto);
    $like=like_dislike($db,$user,$id_foto);
    comment($db,$user,$id_foto);
    $poster=get_utente($db,$id_foto);
    $num_likes = get_likes($db,$id_foto);
?>

<html>
    <head>
        <title>Details</title>
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
        <link rel="stylesheet" href="styles/details.css">
    </head>
    <body>
        <div class="container">

            <div class="header">
                <?php include "header.php"?>
            </div>

            <div class="content">
                <div class="details">
                    <div class="image_content">
                        <img width="700" src="<?php echo $path ?>" alt="">
                    </div>

                    <div class="inf_content">
                        <div class="inf_img">
                            <p>Caricato da: <?php echo $poster ?></p>
                            <p>Likes: <?php echo $num_likes ?></p>
                        </div>

                        <div class="main_form">
                            <form action="" method="post">
                                <div class="like_save">
                                    <input type="submit" name="salva" value="Salva">
                                    <img <?php if($saved==-1) echo "src='images/help/salva_vuoto.png'"; else echo "src='images/help/salva_piena.png'" ;?>height="20px" width="20px" ></img>
                                    <input type="submit" name="like" value="Like">
                                    <img <?php if($like==-1) echo "src='images/help/like_vuoto.png'"; else echo "src='images/help/like_pieno.png'" ;?>height="20px" width="20px" ></img>
                                </div>

                                <div class="comment_form">
                                    <input type="text" name="commento" id="commento" placeholder="Aggiungi un commento" maxlength="255">
                                    <input type="submit" name="fine" value="Fine">
                                </div>
                            </form>
                        </div>

                        <div class="comment_box">
                            <iframe src="commenti.php?id=<?php echo $id_foto?>" title="comment_box"></iframe>
                        </div>

                    </div>

                </div>
            </div>

            <div class="footer">
                <?php include "footer.html"?>
            </div>
        </div>
    </body>
</html>