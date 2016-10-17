<?php
$errors = array();
if (!isDirektor())
	$errors[] = 'Нямате право да изтриете предмет';
elseif (!isset($_GET['ID_predmet'])) 
	$errors[] = 'Не сте избрали предмет!';
elseif ((int)$_GET['ID_predmet']==0) 
	$errors[] = 'Невалиден предмет';
if(count($errors)==0){
	$query = 'SELECT * FROM Predmeti WHERE ID_predmet = '.(int) $_GET['ID_predmet'];
	$res=mysql_query($query);

	if($res === false)
		$errors[] = mysql_error();
	elseif(mysql_num_rows($res) ==0)
		$errors[] = 'Няма такъв предмет';
	else {
		
			$sql = 'DELETE FROM Predmeti WHERE 
			ID_predmet = '.(int) $_GET['ID_predmet'].' LIMIT 1'; 
			$res = mysql_query($sql);
			if($res === false)
				$errors[] = mysql_error();
			 else {
				$_SESSION['success'] = 'Успешно изтриване на предмет от системата';
				header('Location: index.php?page=subjects');
			}
		}
	}

if(count($errors)>0){
	echo '<div class="alert alert-danger">';
	foreach ($errors as $value) {
		echo '<p>'.$value.'</p>';
	}
	echo '</div>';
}