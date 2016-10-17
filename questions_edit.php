<?php

$errors = array();
$question = false;
$res1 = mysql_query('SELECT * 
	FROM Predmeti pr
	LEFT JOIN Predpodavateli_predmeti prpr ON (prpr.ID_predmet = pr.ID_predmet) 
	WHERE prpr.ID_prepodavatel = '.$_SESSION['ID_prepodavatel']);
$predmeti = array();
while ($row = mysql_fetch_assoc($res1)) {
	$predmeti[] = $row;
}

if (!isset($_GET['ID_vuprosi'])) 
		$errors[] = 'Не сте избрали въпрос!';
elseif(isDirektor() && ( !isLogged() || (isLogged() && !$_SESSION['ID_prepodavatel'] != $_GET['ID_vuprosi'])))
	$errors[] = 'Нямате право да редактирате въпрос';
elseif ((int)$_GET['ID_vuprosi']==0)  
	$errors[] = 'Невалиден въпрос';
	
if(!count($errors)) {
	$res = mysql_query('SELECT * FROM Vuprosi WHERE ID_vuprosi = \''.(int)$_GET['ID_vuprosi'].'\'');
	if($res==false){
		$errors[] = mysql_error();
	}elseif (mysql_num_rows($res)==0) {
		$errors[]= 'Не съществува такъв въпрос';
	} else {
		$question = mysql_fetch_assoc($res);
	
	$res2 = mysql_query('SELECT *
		FROM Vuprosi v
		LEFT JOIN  Predmeti pr ON ( v.ID_predmet = pr.ID_predmet )');
		$Predmeti = array();
		while ($row2 = mysql_fetch_assoc($res2)) {
			$Predmeti[$row2['ID_predmet']] = $row2['ime'];
		}
		
		$question['predmeti'] = $Predmeti;

	}	
}

if(!count($errors) AND isset($_POST['subm_edit_quest'])) { 
	if($_POST['question']=='')
		$errors[] = 'Името на въпроса е задължително';
	elseif($_POST['answer1']=='' || $_POST['answer2']=='' || $_POST['answer3']=='' || $_POST['answer4']=='' )
		$errors[] = 'Задаването на отговори е задължително';
	elseif(!isset($_POST['veren']))
		$errors[] = 'Не сте задали верен отговор';
	elseif(!isset($_POST['ID_predmet']))
		$errors[] = 'Не сте задали предмет';
	elseif(!isset($_POST['level']))
		$errors[] = 'Не сте задали ниво на въпроса';
	
	if(count($errors)==0){
		$sql = 'UPDATE Vuprosi SET 
				vupros = \''.$_POST['question'].'\' , 
				otgovor1 = \''.$_POST['answer1'].'\' , 
				otgovor2 = \''.$_POST['answer2'].'\' ,
				otgovor3 = \''.$_POST['answer3'].'\' ,
				otgovor4 = \''.$_POST['answer4'].'\' ,
				pravilen = \''.$_POST['veren'].'\' ,
				level = \''.(int)$_POST['level'].'\',
				ID_predmet = \''.(int)$_POST['ID_predmet'].'\'
				WHERE ID_vuprosi = \''.(int)$_GET['ID_vuprosi'].'\' ';
			
			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			} 
			

			

			if(!count($errors)) {

				$_SESSION['success'] = 'Успешна редакция на въпрос';
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
render('questions_edit',array('question' => $question, 'predmeti' => $predmeti));