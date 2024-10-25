<?php
    session_start();

    require_once 'db.php';

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        pg_prepare($db,"search_user","SELECT * from utente where username=$1");

        $res= pg_execute($db,"search_user",array($username));
        $row=pg_fetch_assoc($res);

        if($row){
            $user = $row['username'];
            $pass = $row['password'];
        }

        if(!isset($user) || password_verify($password,$pass) === false){
            $Err_msg="username o password non corretti";
        } else {
            $_SESSION['username'] = $user;
            header('Location: homepage.php');
            exit();
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/login.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
        <script type="text/javascript" src="scripts/login.js"></script>
    </head>

    <body>
        <div class="container">
            <div class='header'>            
                <?php include 'header.php' ?>
            </div>
            <div class="content">
                <div class="form_login">
                    <form action="login.php" method="post" autocomplete="off">
                        <div class="log_title"><h2>LOGIN</h2></div>
                        <div class="usn"><input id="input_name" type="text" name="username" placeholder="Username"></div>
                        <div class="psw"><input id="input_psw" type="password" name="password" placeholder="Password"></div>
                        <div id="error_msg"><?php if(isset($Err_msg)) echo $Err_msg; ?></div>
                        <div class="subm"><button type="submit" name="login">ACCEDI</button></div>
                    </form>
                    <div class="reg_log">
                        Non sei un membro? <a href="registrazione.php">Registrati</a>!
                    </div>
                </div>
            </div> 
            <div class='footer'>
                <?php include 'footer.html' ?>
            </div>  
        </div>
    </body>
</html>