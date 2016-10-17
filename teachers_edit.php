<?php

$errors = array();
$teacher = false;
$res1 = mysql_query('SELECT * FROM Predmeti');
$predmeti = array();
while ($row = mysql_fetch_assoc($res1)) {
	$predmeti[] = $row;
}

if (!isset($_GET['ID_prepodavatel'])) 
		$errors[] = 'Не сте избрали преподавател!';
	elseif(!isDirektor() && ( !isLogged() || (isLogged() && $_SESSION['ID_prepodavatel'] != $_GET['ID_prepodavatel'])))
		$errors[] = 'Нямате право да редактирате преподавател';
	elseif ((int)$_GET['ID_prepodavatel']==0)  
		$errors[] = 'Невалиден преподавател';
	
if(!count($errors)) {

	$res = mysql_query('SELECT * FROM Prepodavateli WHERE ID_prepodavatel = \''.(int)$_GET['ID_prepodavatel'].'\'');
	if($res==false){
		$errors[] = mysql_error();
	}elseif (mysql_num_rows($res)==0) {
		$errors[]= 'Не съществува такъв преподавател';
	} else {
		$teacher = mysql_fetch_assoc($res);

	$res2 = mysql_query('SELECT *
		FROM Predmeti s
		LEFT JOIN  Predpodavateli_predmeti st ON ( s.ID_predmet = st.ID_predmet )
		WHERE st.ID_prepodavatel = '.$teacher['ID_prepodavatel']);
		$Predmeti = array();
		while ($row2 = mysql_fetch_assoc($res2)) {
			$Predmeti[$row2['ID_predmet']] = $row2['ime'];
		}
		
		$teacher['predmeti'] = $Predmeti;

		}	
}

if(!count($errors) AND isset($_POST['submitedit'])) { 
	if($_POST['username']=='')
		$errors[] = 'Потребителското име е задължително';
	elseif ($_POST['ime']=='') 
		$errors[] = 'Името на преподавателя е зарължително';
	elseif(!isset($_POST['ID_predmet']) && !isDirektor()){
		$errors[] = 'Трябва да зададете предмет';
	}
	if(count($errors)==0){
		$sql = 'UPDATE Prepodavateli SET 
				 ime = \''.$_POST['ime'].'\' ,
				 user_name = \''.$_POST['username'].'\'
				 '.($_POST['password'] != '' ? ' ,  
				 password = \''.md5($_POST['password']).'\' ' : '').'
			   WHERE ID_prepodavatel= '.(int)$_GET['ID_prepodavatel'];
			
			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			} 

			if(!count($errors)) {
				$sql = 'DELETE FROM Predpodavateli_predmeti WHERE 
				ID_prepodavatel = '.(int) $_GET['ID_prepodavatel']; 
				$res = mysql_query($sql);
				if($res === false)
					$errors[] = mysql_error();
			}

			if(!count($errors) && isset($_POST['ID_predmet'])) {
				$sql = 'INSERT INTO Predpodavateli_predmeti (ID_prepodavatel, ID_predmet ) VALUES '; 
				foreach ($_POST['ID_predmet'] as  $id_predmet) {
					$sql .= ' (  '.(int) $_GET['ID_prepodavatel'].', '.$id_predmet.' ),';
				}
				$sql = rtrim($sql, ',');
				if(mysql_query($sql)===false){
					$errors[] = mysql_error();
				} 
			}

			if(!count($errors)) {

				$_SESSION['success'] = 'Успешна редакция на данните на преподавателя';
				header('Location: index.php?page=teachers');
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
render('teachers_edit',array('teacher' => $teacher, 'predmeti' => $predmeti));