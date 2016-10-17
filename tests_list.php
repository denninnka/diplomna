<?php

$sql = 'SELECT t.*, pr.ime as prepodavatel_ime, s.ime as predmet_ime
		FROM Test t 
		LEFT JOIN Prepodavateli pr ON (t.ID_prepodavatel = pr.ID_prepodavatel )
		LEFT JOIN Predmeti s ON (t.ID_predmet = s.ID_predmet) ';
		
if(isTeacher() && !isDirektor())
	$sql .= 'WHERE t.ID_prepodavatel = '.$_SESSION['ID_prepodavatel'];
	
$res = mysql_query($sql);
$test = array();

while($row = mysql_fetch_assoc($res)){
	$res2 = mysql_query('SELECT COUNT(ID_vuprosi) as count
	FROM Test_questions t
	WHERE ID_test = '.$row['ID_test']);
	$row2 = mysql_fetch_assoc($res2);
	
	$row['count_question'] = $row2['count'];
	$test[] = $row;

}

render('tests_list', array('test'=>$test));
