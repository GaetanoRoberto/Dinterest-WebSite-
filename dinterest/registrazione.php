<?php
    require_once 'db.php';
    if(isset($_POST['signin'])){
        pg_prepare($db,"sign_in","INSERT INTO utente values ($1,$2,$3,$4,$5,$6)");
        pg_prepare($db,"search","SELECT * FROM utente WHERE username=$1");
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $mail=$_POST['email'];
        if(!isset($_POST['topic']) || count($_POST['topic'])<3){
            $topic_err="Devi selezionare 3 topic";
        } else{
            $topic=$_POST['topic'];
            $res=pg_execute($db,"search",array($user));
            $row=pg_fetch_assoc($res);
            if(isset($row['username'])){
                $username_err="Username già in uso, riprova";
            } else{
                $pswhash = password_hash($pass,PASSWORD_DEFAULT);
                pg_execute($db,"sign_in",array($user,$mail,$pswhash,$topic[0],$topic[1],$topic[2]));
                $msg = "Registrazione completata, puoi procedere con il login";
            }
        }
    }
?>

<html>
    <head>
        <title>Registrazione</title>
        <link rel="stylesheet" type="text/css" href="styles/registrazione.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
    </head>

    <body>
        <div class="container">
            <div class='header'>            
                <?php include 'header.php' ?>
            </div>
            <div class="content">
                <div class="form_login">
                    <form id="main_form" action="registrazione.php" onsubmit="return validaModulo(this);" method="post" autocomplete="off">
                        <div class="reg_title"><h2>Registrazione</h2></div>
                        <div id="mail" class="mail"><input type="email" id="input_email" onkeyup="checkMail(this)" name="email" placeholder="E-mail"></div>
                        <div id="usn" class="usn"><input id="input_username" onkeyup="checkUsn(this)" type="text" name="username" placeholder="Username"></div>
                        <div id="err"><?php if(isset($username_err)) echo $username_err;?></div>
                        <p class="warning" id="warningUser">Deve contenere almeno 6 caratteri.</p>
                        <div class="psw"><input type="password" id="input_password" name="password" onkeyup="checkPsw(this)" placeholder="Password"></div>
                        <div class="All_warning">
                            <p class="warning" id="capsWarning">Inserisci almeno una lettera maiuscola.</p>
                            <p class="warning" id="lengthWarning">La password deve essere almeno 7 caratteri.</p>
                            <p class="warning" id="checkEmpty">Inserisci una password.</p>
                        </div>
                        <div class="psw"><input type="password" id="repeated_input" onkeyup="checkRepsw(this)" name="re_password" placeholder="Ripeti password"></div>
                        <div class="All warning">
                            <p class="warning" id="checkRpwd">Le password non coincidono</p>
                            <p class="warning" id="checkEmpty">Inserisci una password.</p>
                        </div>
                        <div class="topic_title"><h3>Seleziona 3 topic di tuo interesse</h3></div>
                        <div class="checkboxgroup" id="checkboxgroup">
                            <p><input type="checkbox" value="Videogiochi" name="topic[]">Videogiochi</P>
                            <P><input type="checkbox" value="Animali" name="topic[]">Animali</P>
                            <P><input type="checkbox" value="Bellezza" name="topic[]">Bellezza</P>
                            <P><input type="checkbox" value="Film" name="topic[]">Film</P>
                            <P><input type="checkbox" value="Moda" name="topic[]">Moda</P>
                            <P><input type="checkbox" value="Sport" name="topic[]">Sport</P>
                            <P><input type="checkbox" value="Viaggi" name="topic[]">Viaggi</P>
                            <P><input type="checkbox" value="Cibo" name="topic[]">Cibo</P>
                            <P><input type="checkbox" value="Veicolo" name="topic[]">Veicolo</P>
                        </div>
                        <div id="topic_err"><?php if(isset($topic_err)) echo $topic_err ?></div>
                    </form>
                    <div class="inblock">
                        <div class="subm"><button id="registrati" form="main_form" type="submit" name="signin">Registrati</button></div>
                    </div>
                    <div id="msg"><?php if(isset($msg)) echo $msg;?></div>
                </div>
                <script type="text/javascript" src="scripts/registrazione.js"></script>
                <script>checkTopic()</script>
            </div>
            <div class='footer'>
                <?php include 'footer.html' ?>
            </div>
        </div>     
    </body>
</html>