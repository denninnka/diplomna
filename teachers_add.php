<?php 

$errors = array();
$res = mysql_query('SELECT * FROM Predmeti');
$predmeti = array();
while ($row = mysql_fetch_assoc($res)) {
	$predmeti[] = $row;
}

if(isset($_POST['submitadd'])){
	if(!isDirektor())
		$errors[] = 'Нямате право да добавяте преподавател';
	elseif($_POST['username']=='')
		$errors[] = 'Потребителското име е задължително';
	elseif ($_POST['ime']=='') 
		$errors[] = 'Името на преподавателя е зарължително';
	elseif ($_POST ['password']=='') {
		$errors[] = 'Паролата е задължителна';
	} elseif(!isset($_POST['ID_predmet'])){
		$errors[] = 'Трябва да зададете предмет';
	}
	if(count ($errors)==0){
		$res = mysql_query('SELECT * FROM Prepodavateli 
							WHERE user_name = \''.$_POST['username'].'\'');
		if($res==false){
			$errors[] = mysql_error();
		}elseif (mysql_num_rows($res)>=1) {
			$errors[]= 'Съществува такъв преподавател';
		}else{
			$sql = 'INSERT INTO Prepodavateli(ime , user_name , password ) 
					VALUES( 
							\''.$_POST['ime'].'\' , 
							\''.$_POST['username'].'\' , 
							\''.md5($_POST['password']).'\'
						   )';

			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			}

			if(!count($errors)) {
				$id = mysql_insert_id();
				$sql = 'INSERT INTO Predpodavateli_predmeti (ID_prepodavatel, ID_predmet ) 
						VALUES '; 
				foreach ($_POST['ID_predmet'] as  $id_predmet) {
					$sql .= ' (  '.$id.', '.$id_predmet.' ),';
				}
				$sql = rtrim($sql, ',');
				if(mysql_query($sql)===false){
					$errors[] = mysql_error();
				} 
			}

			if(!count($errors)) {
				$_SESSION['success'] = 'Успешно регистриране на преподавател в системата';
				header('Location: index.php?page=teachers');
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
render('teachers_add', array('predmeti' => $predmeti));
