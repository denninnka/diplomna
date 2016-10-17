<?php 
$errors = array();


	if(!count($errors)){
		$res  = mysql_query('SELECT  ime FROM Test WHERE ID_test = '.(int)$_GET['ID_test']);

		$ime_na_test = mysql_fetch_assoc($res);
		$ime_na_test = $ime_na_test['ime'];

		$res_questions = mysql_query('SELECT * 
			FROM Vuprosi v
			LEFT JOIN Test_questions tq ON (v.ID_vuprosi = tq.ID_vuprosi ) 
			WHERE tq.ID_test = '.(int)$_GET['ID_test']);
		$questions = array();
		while ($row_question = mysql_fetch_assoc($res_questions)) {
			array_push($questions,$row_question);
		}
	}


if(hasFilledTest($_GET['ID_test']))
	$errors[] = 'Вече сте поппълнили този тест!';

	

if (isset($_POST['sbmt_fill_test'])) {
	if(!isStudent())
		$errors[] = 'Нямате право да попълвате тест';
	elseif (!isset($_POST['optionsRadios']) OR (
		isset($_POST['optionsRadios']) AND count($_POST['optionsRadios']) !=count( $questions)
		)) 
		$errors[] = 'Трябва да отговорите на всички въпроси';
	

	if(!count($errors)){
		$submited = $_POST['optionsRadios'];
		$sql = 'INSERT INTO Polojeni ( ID_test, ID_uchenik, data ) 
		VALUES( 
			'.(int)$_GET['ID_test'].',
			'.(int)$_SESSION['ID_uchenik'].',
			\''.@date("Y-m-d").'\'
			) ';
		$res = mysql_query($sql);
		if($res === false ){
			$errors[] = mysql_error();
		} else {
			$id_polojen = mysql_insert_id();


			foreach ($submited as $id_vupros => $orgovor) {
				mysql_query('INSERT INTO Polojeni_vuprosi VALUES (
						'.$id_polojen.',
						'.(int)$id_vupros.',
						'.(int)$orgovor.'
					) ');	
			}
		}
		$verni = array();
		$greshni = array();



		foreach ($questions as $q) {
			if($q['pravilen'] == $submited[$q['ID_vuprosi']])
				$verni[] = $q['ID_vuprosi'].' : '.$q['vupros'];
			else 
				$greshni[] = $q['ID_vuprosi'].' : '.$q['vupros'];

		}
		
		if(!count($errors)) {
			$_SESSION['success'] = 'Успешно попълване на тест. Успех!';
			header('Location: index.php?page=tests');
					
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
	render('fill_test_page' , array(
	'ime_na_test' => $ime_na_test,
	'questions'=> $questions,
		));
