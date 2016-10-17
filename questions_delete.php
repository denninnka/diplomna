<?php
$errors = array();

if (isDirektor() && !isTeacher())
	$errors[] = 'Нямате право да изтриете въпрос';
elseif (!isset($_GET['ID_vuprosi'])) 
	$errors[] = 'Не сте избрали въпрос!';
elseif ((int)$_GET['ID_vuprosi']==0) 
	$errors[] = 'Невалиден въпрос';

if(count($errors)==0){
	$query = 'SELECT * FROM Vuprosi WHERE ID_vuprosi = '.(int) $_GET['ID_vuprosi'];
	$res=mysql_query($query);

	if($res === false)
		$errors[] = mysql_error();
	elseif(mysql_num_rows($res) ==0)
		$errors[] = 'Няма такъв въпрос';
	else {
		$sql = 'DELETE FROM Vuprosi WHERE 
		ID_vuprosi = '.(int) $_GET['ID_vuprosi'].' LIMIT 1'; 
		$res = mysql_query($sql);
		if($res === false)
			$errors[] = mysql_error();
		else {
			$_SESSION['success'] = 'Успешно изтриване на въпрос';
			header('Location: index.php?page=questions');
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