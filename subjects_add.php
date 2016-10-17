<?php 
$errors = array();
if(isset($_POST['subm_add_subj'])){
	if(!isDirektor())
		$errors[] = 'Нямате право да добавяте предмет';
	
	elseif($_POST['ime']=='')
		$errors[] = 'Името на предмета е задължително';
	if(count ($errors)==0){
		$res = mysql_query('SELECT * FROM Predmeti WHERE ime = \''.$_POST['ime'].'\'');
		if($res==false){
			$errors[] = mysql_error();
		}elseif (mysql_num_rows($res)>=1) {
			$errors[]= 'Съществува такъв предмет';
		}else{
			$sql = 'INSERT INTO Predmeti(ime) 
			VALUES( \''.$_POST['ime'].'\' )';

			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			} else {
				$_SESSION['success'] = 'Успешно добавяне на предмет в системата';
				header('Location: index.php?page=subjects');
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
render('subjects_add');
