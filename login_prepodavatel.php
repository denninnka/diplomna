<?php
// echo md5('parolanadirektora');


$errors = array();
if(isset($_POST['submitLogin'])){
	if($_POST['username'] =='')
		$errors[] = 'Потребителското име е задължително';
	elseif ($_POST['password'] =='') {
		$errors[] = 'Паролата е задължителна';
	}

	if(count($errors) == 0){

		$res = mysql_query('SELECT * FROM Prepodavateli WHERE user_name = \''.$_POST['username'].'\' AND password = \''.md5($_POST['password']).'\'');
		if($res == false){
			$errors[] = mysql_error();
		} elseif(mysql_num_rows($res) ==0){
			$errors[] = 'Няма такъв преподавател!';
		} else {
			$danni = mysql_fetch_assoc($res);
			$_SESSION['ID_prepodavatel'] = $danni['ID_prepodavatel'];
			$_SESSION['ime'] = $danni['ime'];
			$_SESSION['username'] = $danni['user_name'];
			$_SESSION['is_logged'] = true;
			$_SESSION['prepodavatel'] = true;
			$_SESSION['direktor'] = (bool)$danni['director'];
			$_SESSION['success'] = 'Успешно влизане в системата';
			header('Location: index.php');
		}
	}
	
}


if(count($errors) > 0){

	echo '<div class="alert alert-danger">';
	foreach ($errors as $value) {
		echo '<p>'.$value.'</p>';
	}
	echo '</div>';
}
 render ('login_prepodavateli');
?>




