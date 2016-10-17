<?php
$errors = array();

if (isDirektor() && !isteacher())
	$errors[] = 'Нямате право да изтриете тест';
elseif (!isset($_GET['ID_test'])) 
	$errors[] = 'Не сте избрали тест!';
elseif ((int)$_GET['ID_test']==0) 
	$errors[] = 'Невалиден тест';

if(count($errors)==0){
	$query = 'SELECT * FROM Test WHERE ID_test = '.(int) $_GET['ID_test'];
	$res=mysql_query($query);

	if($res === false)
		$errors[] = mysql_error();
	elseif(mysql_num_rows($res) ==0)
		$errors[] = 'Няма такъв тест';

	if(count($errors)==0){
		$sql = 'DELETE FROM Test WHERE 
		ID_test = '.(int) $_GET['ID_test'].' LIMIT 1'; 
		$res = mysql_query($sql);
		if($res === false)
			$errors[] = mysql_error();
		else {
			$sql = 'DELETE FROM Test_questions WHERE 
			ID_test = '.(int) $_GET['ID_test']; 
			$res = mysql_query($sql);
			if($res === false)
				$errors[] = mysql_error();
			else {
				$_SESSION['success'] = 'Успешно изтриване на тест';
				header('Location: index.php?page=tests');
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