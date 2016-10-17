<?php

$res = mysql_query('SELECT * FROM Predmeti ');
$subjects = array();

while($row = mysql_fetch_assoc($res)){
	$subjects[] = $row;
}

render('subjects_list', array('subjects'=>$subjects));
