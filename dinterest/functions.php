<?php
    function insert_img($db, $user, $fl_extn, $fl_temp, $topic){
        $file_path = 'images/' . substr(md5(time()), 0, 10) . '.' . $fl_extn;
        $sql = "INSERT INTO foto(img, topic) 
				VALUES($1, $2)";
		$ret = pg_prepare($db,"InsertFoto", $sql); 
		if(!$ret) {
			echo pg_last_error($db); 
		} 
		else {
			$ret = pg_execute($db, "InsertFoto", array($file_path, $topic));
			if(!$ret){
				echo pg_last_error($db);
			}
			else{
				echo 'Immagine inserita';
			}
		}
		move_uploaded_file($fl_temp, $file_path);
		$result = pg_query($db, "SELECT id FROM foto where img='$file_path'");
		$array = pg_fetch_row($result);
		$id = $array[0];
		pg_query($db, "INSERT INTO post(utente, foto) VALUES('$user', $id)");
    }

	function show_php($db){
		$query = pg_query($db, "SELECT * FROM foto");
		while($r = pg_fetch_array($query)){
			?>
				<a href="details.php?path=<?php echo $r['img'] ?>&id=<?php echo $r['id'] ?>">
				<img width="200" src="<?php echo $r['img'] ?>" alt="">
			</a>
		<?php    
		}
	}

	function post_imgs($db,$user){
		$sql="SELECT * FROM post JOIN foto ON foto=id  where utente='$user'";
		$query=pg_query($db,$sql);
		if(!$query){
			echo "ERRORE QUERY: " . pg_last_error($db);
			exit();
		}
		
		while($r = pg_fetch_array($query)){
			?>
            	<div class="column"><a href="details.php?path=<?php echo $r['img'] ?>&id=<?php echo $r['id'] ?>">
				<img width="200" src="<?php echo $r['img'] ?>" alt="">
				</a></div>
        	<?php  
		}
	}

	function saved_imgs($db,$user){
		$sql="SELECT * FROM salvataggio JOIN foto ON foto=id where utente='$user'";
		$query=pg_query($db,$sql);
		if(!$query){
			echo "ERRORE QUERY: " . pg_last_error($db);
			exit();
		}
		
		while($r = pg_fetch_array($query)){
			?>
            	<div class="column"><a href="details.php?path=<?php echo $r['img'] ?>&id=<?php echo $r['id'] ?>">
				<img width="200" src="<?php echo $r['img'] ?>" alt="">
				</a></div>
        	<?php  
		}
	}

	function get_nome($db, $user){
		$result=pg_query($db,"SELECT * FROM utente where username='$user'");
		$row=pg_fetch_row($result);
		return $row[0];
	}

	function display_foto($db, $user){
		$query=pg_query("SELECT topic1,topic2,topic3 FROM utente where username='$user'");
		$topic=pg_fetch_row($query);
		$topic1=$topic[0];
		$topic2=$topic[1];
		$topic3=$topic[2];

		$query=pg_query($db,"SELECT * from foto where topic='$topic1' or topic='$topic2' or topic='$topic3'");
		while($r = pg_fetch_array($query)){
			?>
            	<div class="column"><a href="details.php?path=<?php echo $r['img'] ?>&id=<?php echo $r['id'] ?>">
				<img width="200" src="<?php echo $r['img'] ?>" alt="">
				</a></div>
        	<?php  
		}
	}

	function show_today($db){
		$query = pg_query($db, "SELECT * FROM foto where data = current_date");
		while($r = pg_fetch_array($query)){
			?>
			<div class="column"><a href="details.php?path=<?php echo $r['img'] ?>&id=<?php echo $r['id'] ?>">
				<img width="200" src="<?php echo $r['img'] ?>" alt="">
			</a></div>
		<?php    
		}
	}

	function show_topic($db,$topic){
		$query = pg_query($db, "SELECT * FROM foto where topic = '$topic'");
		while($r = pg_fetch_array($query)){
			?>
			<div class="column"><a href="details.php?path=<?php echo $r['img'] ?>&id=<?php echo $r['id'] ?>">
				<img width="200" src="<?php echo $r['img'] ?>" alt="">
			</a></div>
		<?php    
		}
	}

	function show_comment($db,$id_foto){
		$query = pg_query($db, "SELECT * FROM commento where foto_id='$id_foto'");
		while($r = pg_fetch_array($query)){
			?>
			<p>
				<b><?php echo $r['utente'] ?></b>&nbsp;<?php echo $r['text'] ?>
			</p>
		<?php    
		}
	}

	function get_utente($db,$id_foto){
		$query = pg_query($db, "SELECT * FROM post where foto='$id_foto'");
		while($r = pg_fetch_array($query)){
			return $r['utente']; 
		}
	}

	function get_likes($db,$id_foto){
		$query = pg_query($db, "SELECT * FROM foto where id='$id_foto'");
		while($r = pg_fetch_array($query)){
			return $r['num_likes']; 
		}
	}

	function save_unsave($db,$user,$id_foto){
		$alredy_saved=pg_query($db, "SELECT * FROM salvataggio WHERE utente='$user' and foto='$id_foto'");
		if(!empty($_POST['salva'])){
			if(pg_num_rows($alredy_saved)==0){
				$res = pg_query($db, "INSERT INTO salvataggio(utente, foto) VALUES('$user', $id_foto)");
				return 1;
			}
			else{
				pg_query($db,"DELETE FROM salvataggio WHERE utente='$user' and foto='$id_foto' ");
				return -1;
			}
		}else{
			if(pg_num_rows($alredy_saved)==0){
				return -1;
			}
			else{
				return 1;
			}
		}
	}
	
	
	function like_dislike($db,$user,$id_foto){
		$alredy_liked=pg_query($db, "SELECT * FROM likes WHERE utente='$user' and foto='$id_foto'");
		if(!empty($_POST['like'])){
			if(pg_num_rows($alredy_liked)==0){
				$res = pg_query($db, "INSERT INTO likes(utente, foto) VALUES('$user', $id_foto)");
				pg_query($db, "UPDATE foto SET num_likes = num_likes + 1 WHERE id = '$id_foto' ");
				return 1;
			}
			else{
				pg_query($db,"DELETE FROM likes WHERE utente='$user' and foto='$id_foto' ");
				pg_query($db, "UPDATE foto SET num_likes = num_likes - 1 WHERE id = '$id_foto' ");
				return -1;
			}
		}else{
			if(pg_num_rows($alredy_liked)==0){
				return -1;
			}
			else{
				return 1;
			}
		}    
	
	}
	
	function comment($db,$user,$id_foto){
		if(!empty($_POST['fine']) & !empty($_POST['commento'])){
			$comm = $_POST['commento'];
			pg_query($db, "INSERT INTO commento(text, foto_id, utente) VALUES('$comm', $id_foto, '$user')");
		}
	}

?>