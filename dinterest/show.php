<?php
    require_once 'db.php';
    require 'functions.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
?>

<?php
    $topic = $_GET['topic'];
    if($topic == 'Animali')
        $text = "Scopri curiosità, novità e ricerche sugli animali, dalle migliori 
        idee su come prendersi cura dei cuccioli alle foto più belle!";
    else if($topic == 'Bellezza')
        $text = "Scopri nuovi consigli beauty, per prendersi cura di sé ogni giorno o per trovare 
        l'ispirazione perfetta per un'occasione speciale!";
    else if($topic == 'Cibo')
        $text = "Benvenuto nel mondo del foodporn!";
    else if($topic == 'Film')
        $text = "Scopri curiosità, novità e ricerche sui film del momento!";
    else if($topic == 'Moda')
        $text = "Scopri nuove ispirazioni look e le tendenze del momento!";
    else if($topic == 'Sport')
        $text = "Scopri curiosita, novità e ricerche sugli sport in tutto il mondo!";
    else if($topic == 'Veicoli')
        $text = "Cerchi un veicolo nuovo? Per te o per la famiglia? Troverai qui le risposte alle tue domande!";
    else if($topic == 'Viaggi')
        $text = "Hai voglia di viaggiare? Dove vorresti andare? Scopri tutto ciò di cui hai bisogno 
        prima di partire per la tua prossima destinazione!";
    else
        $text = "Scopri curiosità, novità e ricerche sui videogiochi del momento!";
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
            <h1><?php echo $topic ?></h1>
            <h3><?php echo $text ?></h3>
            <div class="row">
                <?php
                    show_topic($db, $topic);
                ?>
            </div>
            <div class='footer'>
                <?php include 'footer.html' ?>
            </div> 
        </div>    
    </body>
</html>

