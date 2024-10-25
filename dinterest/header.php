<header>
  <nav class="navbar">
    <div class="logo"><a><img src= "images/help/logo.jpg" width = "30" height = "30" margin = "auto"></a></div>
    <ul class="nav-links">
      <div class="menu">
          <?php
            if(isset($_SESSION['username'])){
          ?>
        <li><a href="homepage.php">Homepage</a></li>
        <li><a href="oggi.php">Oggi</a></li>
        <li><a href="esplora.php">Esplora</a></li>
        <li><a href="post.php">Post</a></li>
        <li><a href="profilo.php">Profilo</a></li>
          <?php
            } else {
          ?>
          <li><a href="registrazione.php">Registrati</a>
          <li><a href="login.php">Login</a>
          <?php } ?>
      </div>
    </ul>
  </nav>
</header>