<?php
    session_start();
    if(!isset($_SESSION['username'])){
      header("Location:index.php");
    }
?>

<html>
  <head> 
    <link rel="stylesheet" href="styles/grid.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/header.css">
  </head>
  <body>
    <div class='header'>            
      <?php include 'header.php' ?>
    </div>
    <h1>Esplora Dinterest</h1>
    <div class="wrapper">
      <div class="topic">
        <a href="show.php?topic=Animali" class="topic_title">Animali</a>
        <div class="topic_image">
          <img src="images/topics/animali.jpeg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Bellezza" class="topic_title">Bellezza</a>
        <div class="topic_image">
          <img src="images/topics/bellezza.jpg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Cibo" class="topic_title">Cibo</a>
        <div class="topic_image">
          <img src="images/topics/cibo.jpeg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Film" class="topic_title">Film</a>
        <div class="topic_image">
          <img src="images/topics/film.jpg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Moda" class="topic_title">Moda</a>
        <div class="topic_image">
          <img src="images/topics/moda.jpg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Sport" class="topic_title">Sport</a>
        <div class="topic_image">
          <img src="images/topics/sport.jpeg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Veicoli" class="topic_title">Veicoli</a>
        <div class="topic_image">
          <img src="images/topics/veicoli.jpg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Viaggi" class="topic_title">Viaggi</a>
        <div class="topic_image">
          <img src="images/topics/viaggi.jpg"/>
        </div>
      </div>
      <div class="topic">
        <a href="show.php?topic=Videogiochi" class="topic_title">Videogiochi</a>
        <div class="topic_image">
          <img src="images/topics/videogiochi.jpg"/>
        </div>
      </div>
    </div>
    <div class='footer'>
      <?php include 'footer.html' ?>
    </div>
  </body>
</html>
