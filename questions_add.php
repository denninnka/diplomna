<?php 
$errors = array();

$res1 = mysql_query('SELECT * 
	FROM Predmeti pr
	LEFT JOIN Predpodavateli_predmeti prpr ON (prpr.ID_predmet = pr.ID_predmet) 
	WHERE prpr.ID_prepodavatel = '.$_SESSION['ID_prepodavatel']);
$predmeti = array();
while ($row = mysql_fetch_assoc($res1)) {
	$predmeti[] = $row;
}

if(isset($_POST['subm_add_quest'])){
	if(isDirektor() AND !isTeacher())
		$errors[] = 'Нямате право да добавяте въпрос';
	
	elseif($_POST['vupros']=='')
		$errors[] = 'Името на въпроса е задължително';
	elseif($_POST['answer1']=='' || $_POST['answer2']=='' || $_POST['answer3']=='' || $_POST['answer4']=='' )
		$errors[] = 'Задаването на отговори е задължително';
	elseif(!isset($_POST['veren']))
		$errors[] = 'Не сте задали верен отговор';
	elseif(!isset($_POST['ID_predmet']))
		$errors[] = 'Не сте задали предмет';
	elseif(!isset($_POST['level']))
		$errors[] = 'Не сте задали ниво на въпроса';
	if(count ($errors)==0){
			$sql = 'INSERT INTO Vuprosi(vupros, otgovor1, otgovor2, otgovor3, otgovor4, pravilen,  ID_predmet, level) 
					VALUES( 
							\''.$_POST['vupros'].'\' , 
							\''.$_POST['answer1'].'\' , 
							\''.$_POST['answer2'].'\' ,
							\''.$_POST['answer3'].'\' ,
							\''.$_POST['answer4'].'\' ,
							\''.$_POST['veren'].'\' ,
							\''.(int)$_POST['ID_predmet'].'\' ,
							\''.(int)$_POST['level'].'\' 
						   )';

			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			}			

			if(!count($errors)) {
				$_SESSION['success'] = 'Успешно добавяне на въпрос';
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
render('questions_add' , array('predmeti' => $predmeti));