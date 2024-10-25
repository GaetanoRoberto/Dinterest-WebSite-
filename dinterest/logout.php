<html>
<head>
</head>
<body>
<?php
 	/* attiva la sessione */
	session_start();
	$_SESSION=array();
	
	/* sessione attiva, la distrugge */
	$sname=session_name();
	if(session_id() != "" || isset($_COOKIE[$sname])){
		setcookie($sname,'',time() - 259200,'/');
	}
	session_destroy();
	/* ed elimina il cookie corrispondente */
	
	echo "Logout effettuato con successo, reindirizzamento alla pagina iniziale...";
	header("Refresh: 2; url=index.php");
?>
</body>
</html>