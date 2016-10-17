<?php

$res = mysql_query('SELECT * 
	FROM Vuprosi v
	LEFT JOIN Predmeti pt ON ( v.ID_predmet = pt.ID_predmet)
	LEFT JOIN Predpodavateli_predmeti prpr ON (prpr.ID_predmet = pt.ID_predmet) 
	WHERE prpr.ID_prepodavatel = '.$_SESSION['ID_prepodavatel']);
$questions = array();
if($res === false)
	echo mysql_error();

while($row = mysql_fetch_assoc($res)){
	
	$questions[] = $row;

}

render('questions_list', array('questions'=>$questions));