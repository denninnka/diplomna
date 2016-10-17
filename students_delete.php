<?php
$errors = array();
if (!isDirektor())
	$errors[] = 'Нямате право да изтриете ученик';
elseif (!isset($_GET['ID_uchenik'])) 
	$errors[] = 'Не сте избрали ученик!';
elseif ((int)$_GET['ID_uchenik']==0) 
	$errors[] = 'Невалиден ученик';
if(count($errors)==0){
	$query = 'SELECT * FROM Uchenici WHERE ID_uchenik = '.(int) $_GET['ID_uchenik'];
	$res=mysql_query($query);
	if($res === false)
		$errors[] = mysql_error();
	elseif(mysql_num_rows($res) ==0)
		$errors[] = 'Няма такъв ученик';
	else {
		$student = mysql_fetch_assoc($res);
		$sql = 'DELETE FROM Uchenici 
			    WHERE ID_uchenik = '.(int) $_GET['ID_uchenik'].' LIMIT 1'; 
		$res = mysql_query($sql);
		if($res === false)
			$errors[] = mysql_error();
		else {
			$_SESSION['success'] = 'Успешно изтриване на преподавател от системата';
			header('Location: index.php?page=students');	
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