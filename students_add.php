<?php 
$errors = array();
if(isset($_POST['subm_add_stud'])){
	if(!isDirektor())
		$errors[] = 'Нямате право да добавяте ученик';
	
	elseif($_POST['uchenik']=='')
		$errors[] = 'Името на ученика е задължително';
	elseif($_POST['username']=='')
		$errors[] = 'Потребителското име на ученика е задължително';
	elseif($_POST['password']=='')
		$errors[] = 'Паролата на ученика е задължителна';
	if(count ($errors)==0){
		$res = mysql_query('SELECT * FROM Uchenici WHERE username = \''.$_POST['username'].'\'');
		if($res==false){
			$errors[] = mysql_error();
		}elseif (mysql_num_rows($res)>=1) {
			$errors[]= 'Съществува такъв ученик';
		}else{
			$sql = 'INSERT INTO Uchenici(uchenik, username, password) 
					VALUES( 
						    \''.$_POST['uchenik'].'\',
						    \''.$_POST['username'].'\',
						    \''.md5($_POST['password']).'\' 
						   )';

			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			} else {
				$_SESSION['success'] = 'Успешно добавяне на ученик в системата';
				header('Location: index.php?page=students');
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
render('students_add');