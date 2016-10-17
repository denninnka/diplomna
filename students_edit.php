<?php

$errors = array();
$student = false;

if (!isset($_GET['ID_uchenik'])) 
		$errors[] = 'Не сте избрали ученик!';
	elseif(!isDirektor() && ( !isLogged() || (isLogged() && $_SESSION['ID_uchenik'] != $_GET['ID_uchenik'])))
		$errors[] = 'Нямате право да редактирате данните на ученика';
	elseif ((int)$_GET['ID_uchenik']==0)  
		$errors[] = 'Невалиден ученик';
	
if(!count($errors)) {

	$res = mysql_query('SELECT * FROM Uchenici
						WHERE ID_uchenik = \''.(int)$_GET['ID_uchenik'].'\'');
	if($res==false){
		$errors[] = mysql_error();
	}elseif (mysql_num_rows($res)==0) {
		$errors[]= 'Не съществува такъв ученик';
	}
	else{
		$student = mysql_fetch_assoc($res);
	}
}

if(!count($errors) AND isset($_POST['subm_stud_edit'])) { 
	if($_POST['name_stud']=='')
		$errors[] = 'Името на ученика е зарължително';
	elseif ($_POST['user_name']=='') 
		$errors[] = 'Потребителското име на ученика е задължително';

	if(count($errors)==0){
			
		$sql = 'UPDATE Uchenici SET 
				 uchenik = \''.$_POST['name_stud'].'\' ,
				 username = \''.$_POST['user_name'].'\' 
				 '.($_POST['password'] != '' ? ',
				  password = \''.md5($_POST['password']).'\' ' : '' ).'
			   WHERE ID_uchenik= '.(int)$_GET['ID_uchenik'];

		if(mysql_query($sql)===false){
				$errors[] = mysql_error();
		} 

		if(!count($errors)) {
			$_SESSION['success'] = 'Успешна редакция на данните на ученика';
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
render('students_edit',array('student' => $student));