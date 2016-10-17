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

if(isset($_POST['subm_add_test'])){
	if(isDirektor() && !isteacher())
		$errors[] = 'Нямате право да съсдавате тест';
	elseif($_POST['test_name']=='')
		$errors[] = 'Името на теста е задължително';
	elseif (!isset($_POST['ID_predmet'])) 
		$errors[] = 'Задаването на предмет е зарължително';
	elseif (!isset($_POST ['level'])) {
		$errors[] = 'Задаването на ниво на предмета е задължително';
	} elseif(!isset($_POST['count_question'])){
		$errors[] = 'Задаването на брой въпроси е задължително';
	}
	if(count ($errors)==0){
		$res = mysql_query('SELECT * FROM Test
							WHERE ime = \''.$_POST['test_name'].'\'');
		if($res==false){
			$errors[] = mysql_error();
		}elseif (mysql_num_rows($res)>=1) {
			// $errors[]= 'Съществува такъв тест';
		}else{
			$sql = 'INSERT INTO Test(ime , ID_prepodavatel , ID_predmet, level ) 
					VALUES( 
							\''.$_POST['test_name'].'\' , 
							\''.$_SESSION['ID_prepodavatel'].'\' , 
							\''.$_POST['ID_predmet'].'\' , 
							\''.$_POST['level'].'\' 
						   )';

			if(mysql_query($sql)===false){
				$errors[] = mysql_error();
			}
			if(!count($errors)) {
				$id = mysql_insert_id();

				$sql = 'SELECT * FROM Vuprosi 
				WHERE ID_predmet = '.(int)$_POST['ID_predmet'].' 
						AND level = '.(int)$_POST['level'].' 
				ORDER BY RAND()
				LIMIT '.(int)$_POST['count_question'];

				$res = mysql_query($sql);
				if($res === false){
					$errors[] = mysql_error();
				} else {



					while ($row = mysql_fetch_assoc($res)) {
						$sql = 'INSERT INTO Test_questions ( ID_test,ID_vuprosi ) 
							VALUES ( '.$id.', '.$row['ID_vuprosi'].') ';
						$res2 = mysql_query($sql);
						if($res2 === false){
							$errors[] = mysql_error();
						}

					
					}
				}
				
			}
			
			if(!count($errors)) {
				$_SESSION['success'] = 'Успешно създаване на тест';
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
render('tests_add' , array('predmeti' => $predmeti));