<?php
$errors = array();

if (!isDirektor())
	$errors[] = 'Нямате право да изтриете преподавател';
elseif (!isset($_GET['ID_prepodavatel'])) 
	$errors[] = 'Не сте избрали преподавател!';
elseif ((int)$_GET['ID_prepodavatel']==0) 
	$errors[] = 'Невалиден преподавател';

if(count($errors)==0){
	$query = 'SELECT * FROM Prepodavateli WHERE ID_prepodavatel = '.(int) $_GET['ID_prepodavatel'];
	$res=mysql_query($query);

	if($res === false)
		$errors[] = mysql_error();
	elseif(mysql_num_rows($res) ==0)
		$errors[] = 'Няма такъв преподавател';
	else {
		$teacher = mysql_fetch_assoc($res);
		if($teacher['director'])
			$errors[] = 'Не можете да изтриете директора';
		else {
			$sql = 'DELETE FROM Prepodavateli WHERE 
			ID_prepodavatel = '.(int) $_GET['ID_prepodavatel'].' LIMIT 1'; 
			$res = mysql_query($sql);
			if($res === false)
				$errors[] = mysql_error();
			 else {
			 	$sql = 'DELETE FROM Predpodavateli_predmeti WHERE 
				ID_prepodavatel = '.(int) $_GET['ID_prepodavatel']; 
				$res = mysql_query($sql);
				if($res === false)
					$errors[] = mysql_error();
				 else {
					$_SESSION['success'] = 'Успешно изтриване на преподавател от системата';
					header('Location: index.php?page=teachers');
				}
			}
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